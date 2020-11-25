<template>
  <div class="q-pa-md">
    <q-stepper v-model="step" ref="stepper" contracted color="primary" animated>
      <q-step
        :name="1"
        title="Select settings"
        icon="settings"
        :done="step > 1"
        done-color="positive"
        active-color="light-green-3 "
      >
        <div class="q-pa-md row items-center q-gutter-md">
          <step_1 @next="setTab" />
        </div>
      </q-step>

      <q-step
        :name="2"
        title="Create an ad group"
        caption="Optional"
        icon="create_new_folder"
        :done="step > 2"
        done-color="positive"
        active-color="light-green-3 "
      >
        <step_2 @next="setTab" />
      </q-step>

      <q-step
        :name="3"
        title="Create an ad"
        icon="add_comment"
        :done="step > 3"
        done-color="positive"
        active-color="light-green-3 "
      >
        <step_3 @next="setTab" />
      </q-step>
      <q-step
        :name="4"
        title="Create an ad"
        icon="add_comment"
        :done="step > 4"
        done-color="positive"
        active-color="light-green-3 "
      >
        <step_4 @next="setTab" />
      </q-step>
      <q-step
        :name="5"
        title="Create an ad"
        icon="add_comment"
        :done="step > 5"
        done-color="positive"
        active-color="light-green-3 "
      >
        <step_5  @next="setTab"></step_5>
      </q-step>
      <q-step
        :name="6"
        title="Create an ad"
        icon="add_comment"
        :done="step > 6"
        done-color="positive"
        active-color="light-green-3 "
      >
        <step_6  @next="setTab"></step_6>
      </q-step>
      <q-step
        :name="7"
        title="Create an ad"
        icon="add_comment"
        :done="step > 7"
        done-color="positive"
        active-color="light-green-3 "
      >
        <step_7  @next="setTab"></step_7>
      </q-step>
    </q-stepper>
  </div>
</template>
<script>
import SystemRequirement from "./SystemRequirement";
import Permission from "./Permission";
import Database from "./Database";
import EmailConfiguration from "./EmailConfiguration";
import UserProfile from "./UserProfile";
import CompanyProfile from "./CompanyProfile";
import GeneralSetting from "./GeneralSetting";

export default {
  components: {
    step_1: SystemRequirement,
    step_2: Permission,
    step_3: Database,
    step_4: EmailConfiguration,
    step_5: UserProfile,
    step_6: CompanyProfile,
    step_7: GeneralSetting
  },
  data() {
    return {
      step: 1,
      tab: "step_1"
    };
  },
  created() {
    this.getOnboardingData();
  },
  methods: {
    async getOnboardingData() {
      let response = await this.axios.get("/api/admin/onboarding");
      if (response.data) {
        console.log(response.data);
        if (response.data.profile_complete === "COMPLETED") {
          this.$router.push("/");

          return;
        }
        let dbStep = parseInt(response.data.profile_complete);

        if (dbStep) {
          this.step = dbStep + 1;
          this.tab = `step_${dbStep + 1}`;
        }

        this.languages = response.data.languages;
        this.currencies = response.data.currencies;
        this.dateFormats = response.data.date_formats;
        this.timeZones = response.data.time_zones;

        // this.settingData.currency = this.currencies.find(currency => currency.id === 1)
        // this.settingData.language = this.languages.find(language => language.code === 'en')
        // this.settingData.dateFormat = this.dateFormats.find(dateFormat => dateFormat.value === 'd M Y')
      }
    },
    setTab(isNext) {
      if (isNext) {
        this.$refs.stepper.next();
      } else {
        // window.location.reload()
      }
    }
  }
};
</script>
