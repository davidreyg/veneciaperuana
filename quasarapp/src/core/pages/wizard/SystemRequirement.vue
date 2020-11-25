<template>
  <div class="row fit q-gutter-md">
    <!-- <div class="col-12">
      <div class="locale-changer">
        <select v-model="$i18n.locale">
          <option v-for="(lang, i) in langs" :key="`Lang${i}`" :value="lang">{{
            lang
          }}</option>
        </select>
      </div>
    </div> -->
    <div class="col-auto">
      <div class="text-h5 text-bold">{{ $t('wizard.req.system_req') }}</div>
      <q-separator spaced />
      <div class="text-subtitle2 text-italic text-weight-light">
        Php y Apache
      </div>
      <div>{{ $t('wizard.req.system_req_desc') }}</div>
    </div>

    <div class="col-12">
      <div v-if="requirements" class="row justify-content-start">
        <div class="col-sm-12 col-md-6 col-xs-12">
          <div v-if="phpSupportInfo">
            <q-item clickable v-ripple>
              <q-item-section>
                <q-item-label lines="1">
                  {{
                    $t('wizard.req.php_req_version', {
                      version: phpSupportInfo.minimum
                    })
                  }}</q-item-label
                >
              </q-item-section>
              <q-item-section side top>
                {{ phpSupportInfo.current }}
              </q-item-section>
              <q-item-section side>
                <q-icon
                  :name="
                    phpSupportInfo.supported ? 'done_outline' : 'report_problem'
                  "
                  :color="phpSupportInfo.supported ? 'positive' : 'negative'"
                />
              </q-item-section>
            </q-item>
          </div>
          <q-list v-for="(requirement, index) in requirements" :key="index">
            <q-item clickable v-ripple>
              <q-item-section>
                <q-item-label lines="1" v-text="index"></q-item-label>
              </q-item-section>

              <q-item-section side>
                <q-icon
                  :name="requirement ? 'done_outline' : 'report_problem'"
                  :color="requirement ? 'positive' : 'negative'"
                />
              </q-item-section>
            </q-item>
          </q-list>
        </div>
      </div>
    </div>

    <div class="col-12 q-pt-xl">
      <q-btn
        v-if="hasNext"
        color="primary"
        icon="check"
        @click="next"
        :loading="loading"
      >
        {{ $t('wizard.continue') }}
      </q-btn>
      <q-btn
        v-if="!hasNext"
        color="primary"
        icon="check"
        @click="getRequirements"
        :loading="loading"
      >
        {{ $t('wizard.req.check_req') }}
      </q-btn>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SystemRequirement',
  data() {
    return {
      da: '',
      langs: ['es', 'en'],
      loading: false,
      requirements: null,
      phpSupportInfo: null
    }
  },
  methods: {
    async getRequirements() {
      this.loading = true

      let response = await this.axios.get('/api/admin/onboarding/requirements')
      console.log(response.data)

      if (response.data) {
        this.requirements = response.data.requirements.requirements.php
        this.phpSupportInfo = response.data.phpSupportInfo
        this.loading = false
      }
    },
    async next() {
      this.loading = true
      await this.$emit('next', true)
      this.loading = false
    }
  },
  computed: {
    hasNext() {
      if (this.requirements) {
        let isRequired = true
        for (const key in this.requirements) {
          if (!this.requirements[key]) {
            isRequired = false
          }
        }
        return this.requirements && this.phpSupportInfo.supported && isRequired
      }
      return false
    }
  }
}
</script>

<style></style>
