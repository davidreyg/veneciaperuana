<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated class="bg-primary text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg" />
          </q-avatar>
          FacturacionMVC
        </q-toolbar-title>
        <q-btn-dropdown stretch flat label="Idioma">
          <q-list
            v-for="(language, index) in options"
            :key="`Lang${index}`"
            :value="language"
            @click="setLanguage(language)"
          >
            <q-item clickable v-close-popup tabindex="0">
              <q-item-section>
                <q-item-label>{{ language }}</q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-btn-dropdown>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { localize } from "vee-validate";

export default {
  name: "LayoutWizard",
  data() {
    return {
      options: ["es", "en"]
    };
  },

  mounted() {
    this.setLayoutBackground();
  },

  destroyed() {
    document.body.style.backgroundColor = "#EBF1FA";
  },

  methods: {
    setLayoutBackground() {
      document.body.style.backgroundColor = "#f9fbff";
    },
    setLanguage(selectedLanguage) {
      this.$i18n.locale = selectedLanguage;
      // Install and Activate the Arabic locale.
      localize(selectedLanguage);
    }
  }
};
</script>
