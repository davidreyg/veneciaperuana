<template>
  <div class="row fit">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="text-h5 text-bold">{{ $t('wizard.preferences') }}</div>
      <q-separator spaced />
      <div>{{ $t('wizard.preferences_desc') }}</div>
    </div>

    <div class="col-12 q-pt-md">
      <ValidationObserver ref="observer">
        <form @submit.prevent="next">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelCurrency"
                v-slot="{ errors, invalid, validated }"
              >
                <q-select
                  dense
                  options-dense
                  outlined
                  option-value="id"
                  option-label="name"
                  v-model="settingData.currency"
                  :options="currencies"
                  :label="labelCurrency"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-select>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelLanguage"
                v-slot="{ errors, invalid, validated }"
              >
                <q-select
                  dense
                  options-dense
                  outlined
                  option-value="code"
                  option-label="name"
                  v-model="settingData.language"
                  :options="languages"
                  :label="labelLanguage"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-select>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelDateFormat"
                v-slot="{ errors, invalid, validated }"
              >
                <q-select
                  dense
                  options-dense
                  outlined
                  option-value="display_date"
                  option-label="display_date"
                  v-model="settingData.dateFormat"
                  :options="dateFormats"
                  :label="labelDateFormat"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-select>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelTimeZone"
                v-slot="{ errors, invalid, validated }"
              >
                <q-select
                  dense
                  options-dense
                  outlined
                  option-value="key"
                  option-label="value"
                  v-model="settingData.timeZone"
                  :options="timeZones"
                  :label="labelTimeZone"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-select>
              </ValidationProvider>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelFiscalYear"
                v-slot="{ errors, invalid, validated }"
              >
                <q-select
                  dense
                  options-dense
                  outlined
                  option-value="value"
                  option-label="key"
                  v-model="settingData.fiscalYear"
                  :options="fiscalYears"
                  :label="labelFiscalYear"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                </q-select>
              </ValidationProvider>
            </div>
            <div class="col-12 q-pt-xl">
              <q-btn
                color="primary"
                icon="save"
                type="submit"
                :loading="loading"
                >{{ $t('wizard.save_cont') }}</q-btn
              >
            </div>
          </div>
        </form>
      </ValidationObserver>
    </div>
  </div>
</template>

<script>
import { ValidationObserver } from 'vee-validate'
import { mapActions } from 'vuex'
export default {
  name: 'CompanyProfile',
  components: { ValidationObserver },
  data() {
    return {
      settingData: {
        language: null,
        currency: null,
        timeZone: null,
        dateFormat: null,
        fiscalYear: null
      },
      loading: false,
      languages: [],
      currencies: [],
      timeZones: [],
      dateFormats: [],
      fiscalYears: []
    }
  },
  mounted() {
    this.getOnboardingData()
  },
  methods: {
    // ...mapActions('userProfile', ['uploadOnboardAvatar']),
    async getOnboardingData() {
      let response = await this.axios.get('/api/admin/onboarding')
      if (response.data) {
        if (response.data.profile_complete === 'COMPLETED') {
          this.$router.push('/')

          return
        }

        let dbStep = parseInt(response.data.profile_complete)

        if (dbStep) {
          this.step = dbStep + 1
        }

        this.languages = response.data.languages
        this.currencies = response.data.currencies
        this.dateFormats = response.data.date_formats
        this.timeZones = response.data.time_zones
        this.fiscalYears = response.data.fiscal_years

        this.settingData.currency = this.currencies.find(
          currency => currency.id === 2
        )
        this.settingData.language = this.languages.find(
          language => language.code === 'en'
        )
        this.settingData.dateFormat = response.data.date_formats.find(
          dateFormat => dateFormat.carbon_format_value == 'd M Y'
        )

        this.settingData.timeZone = this.timeZones.find(
          timeZone => timeZone.value === 'UTC'
        )
        this.settingData.fiscalYear = this.fiscalYears.find(
          fiscalYear => fiscalYear.value === '1-12'
        )
      }
    },

    async next() {
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

      let data = {
        currency: this.settingData.currency.id,
        time_zone: this.settingData.timeZone.value,
        language: this.settingData.language.code,
        fiscal_year: this.settingData.fiscalYear.value,
        carbon_date_format: this.settingData.dateFormat.carbon_format_value,
        moment_date_format: this.settingData.dateFormat.moment_format_value
      }

      let response = await this.axios.post(
        '/api/admin/onboarding/settings',
        data
      )

      if (response.data) {
        // this.$emit('next')
        this.loading = false
        // Ls.set('auth.token', response.data.token)
        // this.loginOnBoardingUser(response.data.token)
        // window.toastr['success']('Login Successful')
        this.$router.push('/')
      }
    }
  },
  computed: {
    labelCurrency() {
      return this.$t('wizard.currency')
    },
    labelLanguage() {
      return this.$t('wizard.language')
    },
    labelDateFormat() {
      return this.$tc('wizard.date_format')
    },
    labelTimeZone() {
      return this.$t('wizard.time_zone')
    },
    labelFiscalYear() {
      return this.$tc('wizard.fiscal_year')
    },
    currencyNameWithCode({ name, code }) {
      return code
    }
  }
}
</script>

<style></style>
