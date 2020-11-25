<template>
  <div class="row fit">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="text-h5 text-bold">
        {{ $t('wizard.database.database') }}
      </div>
      <q-separator spaced />
      <div>{{ $t('wizard.database.desc') }}</div>
    </div>

    <div class="col-12 q-pt-md">
      <ValidationObserver ref="observer">
        <form @submit.prevent="nextStep">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required|url"
                :name="labelUrlApp"
                v-slot="{ invalid, validated }"
              >
                <q-input
                  outlined
                  dense
                  v-model.trim="databaseData.app_url"
                  type="text"
                  :label="labelUrlApp"
                  :error="invalid && validated"
                  :error-message="errorUrlApp"
                >
                </q-input>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelConnectionType"
                v-slot="{ errors, invalid, validated }"
              >
                <q-select
                  dense
                  options-dense
                  outlined
                  v-model="databaseData.database_connection"
                  :options="connections"
                  :label="labelConnectionType"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-select>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required|numeric|max:4"
                :name="labelPort"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  dense
                  outlined
                  v-model.trim="databaseData.database_port"
                  type="text"
                  :label="labelPort"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-input>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelDatabaseName"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  dense
                  outlined
                  v-model.trim="databaseData.database_name"
                  type="text"
                  :label="labelDatabaseName"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-input>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelDatabaseUsername"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  dense
                  outlined
                  v-model.trim="databaseData.database_username"
                  type="text"
                  :label="labelDatabaseUsername"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-input>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules=""
                :name="labelDatabasePassword"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  dense
                  outlined
                  v-model.trim="databaseData.database_password"
                  type="text"
                  :label="labelDatabasePassword"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-input>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelDatabaseHost"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  dense
                  outlined
                  v-model.trim="databaseData.database_hostname"
                  type="text"
                  :label="labelDatabaseHost"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-input>
              </ValidationProvider>
            </div>
            <div class="col-12 q-pt-xl">
              <q-btn
                color="primary"
                icon="save"
                type="submit"
                :loading="loading"
              >
                {{ $t('wizard.save_cont') }}
              </q-btn>
            </div>
          </div>
        </form>
      </ValidationObserver>
    </div>
  </div>
</template>

<script>
import { ValidationObserver } from 'vee-validate'

export default {
  name: 'Database',
  components: { ValidationObserver },
  data() {
    return {
      databaseData: {
        database_connection: 'mysql',
        database_hostname: '127.0.0.1',
        database_port: '3306',
        database_name: null,
        database_username: null,
        database_password: null,
        app_url: window.location.origin
      },
      loading: false,
      connections: ['sqlite', 'mysql', 'pgsql', 'sqlsrv']
    }
  },
  methods: {
    async nextStep() {
      const isValid = await this.$refs.observer.validate()
      if (!isValid) {
        this.$q.notify({
          type: 'negative',
          position: 'top-right',
          message: this.$t('wizard.database.database_error')
        })
        return
      }
      this.loading = true
      try {
        let response = await this.axios.post(
          '/api/admin/onboarding/environment/database',
          this.databaseData
        )
        if (response.data.success) {
          this.$q.notify({
            type: 'positive',
            position: 'top-right',
            message: this.$t('wizard.success.' + response.data.success)
          })
          this.$emit('next', true)
          return true
        } else if (response.data.error) {
          this.$q.notify({
            type: 'negative',
            position: 'top-right',
            message: this.$t('wizard.errors.' + response.data.error)
          })
        } else if (response.data.error_message) {
          this.$q.notify({
            type: 'negative',
            position: 'top-right',
            message: response.data.error_message
          })
        }
      } catch (e) {
        this.$q.notify({
          type: 'negative',
          position: 'top-right',
          message: e
        })
        if (e.response.data.message) {
          this.$q.notify({
            type: 'negative',
            position: 'top-right',
            message: e.response.data.message
          })
        }
      } finally {
        this.loading = false
      }
    }
  },
  computed: {
    labelUrlApp() {
      return `${this.$t('wizard.database.app_url')} (*)`
    },
    labelConnectionType() {
      return `${this.$t('wizard.database.connection')} (*)`
    },
    labelPort() {
      return `${this.$t('wizard.database.port')} (*)`
    },
    errorUrlApp() {
      return this.$t('wizard.database.app_url_error')
    },
    labelDatabaseName() {
      return `${this.$t('wizard.database.db_name')} (*)`
    },
    labelDatabaseUsername() {
      return `${this.$t('wizard.database.username')} (*)`
    },
    labelDatabasePassword() {
      return `${this.$t('wizard.database.password')} (*)`
    },
    labelDatabaseHost() {
      return this.$t('wizard.database.host')
    }
  }
}
</script>
<style></style>
