<template>
  <div class="row fit">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="text-h5 text-bold">{{ $t('wizard.company_info') }}</div>
      <q-separator spaced />
      <div>{{ $t('wizard.company_info_desc') }}</div>
    </div>

    <div class="col-12 q-pt-md">
      <ValidationObserver ref="observer">
        <form @submit.prevent="next">
          <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12 q-pa-sm">
              <q-uploader
                style="max-width: 300px"
                :label="labelLogo"
                accept=".jpg, image/*"
                @added="fileSelected"
              />
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 q-pa-sm">
              <ValidationProvider
                rules="required"
                :name="labelCompanyName"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  outlined
                  dense
                  v-model.trim="companyData.name"
                  type="text"
                  :label="labelCompanyName"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                ></q-input>
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
      companyData: {
        logo: '',
        name: null
      },
      loading: false
    }
  },
  methods: {
    ...mapActions('userProfile', ['uploadOnboardAvatar']),
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
      let response = await this.axios.post(
        '/api/admin/onboarding/company',
        this.companyData
      )
      const COMPANY_ID = response.data.user.company.id
      if (COMPANY_ID) {
        let logoData = new FormData()
        logoData.append('logo', this.companyData.logo)
        await this.axios.post(
          '/api/admin/onboarding/company/upload-logo',
          logoData,
          {
            headers: {
              'Content-Type': 'multipart/form-data',
              company: COMPANY_ID
            }
          }
        )
        this.$emit('next', true)
        this.loading = false
      }
      return true
    },
    fileSelected(file) {
      this.companyData.logo = file[0]
    }
  },
  computed: {
    labelProfilePicture() {
      return this.$t('settings.account_settings.profile_picture')
    },
    labelCompanyName() {
      return this.$t('wizard.company_name')
    },
    labelLogo() {
      return this.$tc('general.choose_file')
    }
  }
}
</script>

<style></style>
