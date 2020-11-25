<template>
  <q-footer elevated class="bg-grey-8 text-white" height-hint="20">
    <q-toolbar>
      <q-toolbar-title>
        <q-avatar>
          <img src="statics/img/quasar-logo.svg" />
        </q-avatar>
        <div class="text-right">
          {{ $t('general.powered_by') }}
          <a href="http://bytefury.com/" target="_blank"
            >{{ $t('general.bytefury') }}
          </a>
        </div>
      </q-toolbar-title>
    </q-toolbar>
  </q-footer>
</template>

<script>
export default {
  name: 'AppFooter'
}
</script>

<style></style>
