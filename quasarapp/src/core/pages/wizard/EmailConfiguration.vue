<template>
  <div class="row fit q-gutter-md">
    <div class="col-auto">
      <div class="text-h5 text-bold">
        {{ $t('wizard.mail.mail_config') }}
      </div>
      <q-separator spaced />
      <div>{{ $t('wizard.mail.mail_config_desc') }}</div>
    </div>

    <div class="col-12 q-pt-md">
      <ValidationObserver ref="observer">
        <form @submit.prevent="next">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelMailDriver"
                v-slot="{ errors, invalid, validated }"
              >
                <q-select
                  dense
                  options-dense
                  outlined
                  v-model="mailConfigData.mail_driver"
                  :options="mail_drivers"
                  :label="labelMailDriver"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-select>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelHost"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  dense
                  outlined
                  v-model.trim="mailConfigData.mail_host"
                  type="text"
                  :label="labelHost"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-input>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelUsername"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  dense
                  outlined
                  v-model.trim="mailConfigData.mail_username"
                  type="text"
                  :label="labelUsername"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-input>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelPassword"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  dense
                  outlined
                  v-model.trim="mailConfigData.mail_password"
                  type="password"
                  :label="labelPassword"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-input>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required|numeric"
                :name="labelPort"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  dense
                  outlined
                  v-model.trim="mailConfigData.mail_port"
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
                :name="labelEncryption"
                v-slot="{ errors, invalid, validated }"
              >
                <q-select
                  dense
                  options-dense
                  :options="encryptions"
                  outlined
                  v-model.trim="mailConfigData.mail_encryption"
                  :label="labelEncryption"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-select>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelFromMail"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  dense
                  outlined
                  v-model.trim="mailConfigData.from_mail"
                  type="text"
                  :label="labelFromMail"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-input>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelFromName"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  dense
                  outlined
                  v-model.trim="mailConfigData.from_name"
                  type="text"
                  :label="labelFromName"
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
                {{ $t('general.save') }}
              </q-btn>
            </div>
          </div>
        </form>
        <!-- <q-banner v-show="dirty"  class="text-white bg-red">
                    <div v-for="(error, index) in errors" :key="index">
                        <div>{{ error[0] }}</div>
                    </div>
                                    <slot #avatar>
                    <q-icon name="error" color="white" />
                </slot>
                </q-banner> -->
      </ValidationObserver>
    </div>
  </div>
</template>

<script>
import { ValidationObserver } from 'vee-validate'

export default {
  name: 'EmailCOnfiguration',
  components: { ValidationObserver },
  data() {
    return {
      loading: false,
      mail_drivers: [],
      mailConfigData: {
        mail_driver: '',
        mail_host: '',
        mail_port: null,
        mail_username: '',
        mail_password: '',
        mail_encryption: 'tls',
        from_mail: '',
        from_name: ''
      },
      encryptions: ['tls', 'ssl', 'starttls']
    }
  },
  created() {
    this.getMailDrivers()
  },
  methods: {
    async getMailDrivers() {
      this.loading = true
      let response = await this.axios.get(
        '/api/admin/onboarding/environment/mail'
      )
      if (response.data) {
        this.mail_drivers = response.data
        this.loading = false
      }
    },
    async next() {
      const isValid = await this.$refs.observer.validate()
      if (!isValid) {
        this.$q.notify({
          type: 'negative',
          position: 'top-right',
          message: this.$t('wizard.errors.mail_variables_save_error')
        })
        return
      }
      this.loading = true
      try {
        let response = await this.axios.post(
          '/api/admin/onboarding/environment/mail',
          this.mailConfigData
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
    labelMailDriver() {
      return this.$t('wizard.mail.driver')
    },
    labelFromMail() {
      return this.$t('wizard.mail.from_mail')
    },
    labelFromName() {
      return this.$t('wizard.mail.from_name')
    },
    labelHost() {
      return this.$t('wizard.mail.host')
    },
    labelUsername() {
      return this.$t('wizard.mail.username')
    },
    labelPassword() {
      return this.$t('wizard.mail.password')
    },
    labelPort() {
      return this.$t('wizard.mail.port')
    },
    labelEncryption() {
      return this.$t('wizard.mail.encryption')
    }
  }
}
</script>
<style></style>
