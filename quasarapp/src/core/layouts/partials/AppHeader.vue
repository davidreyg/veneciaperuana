<template>
  <q-header elevated class="bg-primary text-white">
    <q-toolbar>
      <q-btn
        dense
        flat
        round
        icon="menu"
        @click="$emit('left-drawer', !left)"
      />

      <q-toolbar-title>
        <q-avatar>
          <img src="statics/img/quasar-logo.svg" />
        </q-avatar>
        Facturacion con Laravel
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
      <q-btn dense flat round icon="account_circle">
        <q-menu>
          <div class="row no-wrap q-pa-md">
            <div class="column">
              <div class="text-h6 q-mb-md">Settings</div>
              <q-input
                :value="'Administrador'"
                type="text"
                label="Tipo"
                readonly
              />
            </div>

            <q-separator vertical inset class="q-mx-lg" />

            <div class="column items-center">
              <q-avatar size="72px">
                <img src="https://cdn.quasar.dev/img/avatar4.jpg" />
              </q-avatar>

              <div class="text-subtitle1 q-mt-md q-mb-xs">John Doe</div>

              <q-btn
                color="primary"
                label="Logout"
                push
                size="sm"
                @click="cerrarSesion"
              />
            </div>
          </div>
        </q-menu>
      </q-btn>
    </q-toolbar>
  </q-header>
</template>

<script>
import { localize } from "vee-validate";
export default {
  name: 'AppHeader',
  props: ['left'],
  data() {
    return {
      options: ['es', 'en']
    }
  },
  methods: {
    cerrarSesion() {
      this.$auth.logout({
        makeRequest: true,
        redirect: '/auth/login'
        // etc...
      })
    },
    setLanguage(selectedLanguage) {
      this.$i18n.locale = selectedLanguage
      // Install and Activate the Arabic locale.
      localize(selectedLanguage)
    }
  }
}
</script>
