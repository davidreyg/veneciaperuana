<template>
  <div class="row fit q-gutter-md">
    <div class="col-auto">
      <div class="text-h5 text-bold">
        {{ $t("wizard.permissions.permissions") }}
      </div>
      <q-separator spaced />
      <div>{{ $t("wizard.permissions.permission_desc") }}</div>
    </div>

    <div class="col-12">
      <div class="row justify-content-start">
        <div class="col-sm-12 col-md-6 col-xs-12">
          <q-list v-for="(permission, index) in permissions" :key="index">
            <q-item clickable v-ripple>
              <q-item-section>
                <q-item-label
                  lines="1"
                  v-text="permission.folder"
                ></q-item-label>
              </q-item-section>
              <q-item-section side top>
                {{ permission.permission }}
              </q-item-section>
              <q-item-section side>
                <q-icon
                  :name="permission.isSet ? 'done_outline' : 'report_problem'"
                  :color="permission.isSet ? 'positive' : 'negative'"
                />
              </q-item-section>
            </q-item>
          </q-list>
        </div>
      </div>
    </div>

    <div class="col-12 q-pt-xl">
      <q-btn
        v-if="isContinue"
        color="primary"
        icon="check"
        @click="next"
        :loading="loading"
      >
        {{ $t("wizard.continue") }}
      </q-btn>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      permissions: [],
      errors: false,
      isContinue: false
    };
  },
  created() {
    this.getPermissions();
  },
  methods: {
    async getPermissions() {
      this.loading = true;
      let response = await this.axios.get(
        "/api/admin/onboarding/permissions",
        this.profileData
      );
      if (response.data) {
        this.permissions = response.data.permissions.permissions;
        this.errors = response.data.permissions.errors;
        let self = this;
        if (this.errors) {
          swal({
            title: this.$t("wizard.permissions.permission_confirm_title"),
            text: this.$t("wizard.permissions.permission_confirm_desc"),
            icon: "warning",
            buttons: true,
            dangerMode: true
          }).then(async willConfirm => {
            if (willConfirm) {
              self.isContinue = true;
            }
          });
        } else {
          this.isContinue = true;
        }
        this.loading = false;
      }
    },
    async next() {
      this.loading = true;
      await this.$emit("next", true);
      this.loading = false;
    }
  }
};
</script>
<style>
</style>
