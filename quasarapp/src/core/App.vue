<template>
  <div id="q-app">
    <transition
      appear
      name="appTransition"
      appear-active-class="animated pulse"
      enter-active-class="animated fadeIn"
      leave-active-class="animated fadeOut"
      mode="out-in"
    >
      <router-view />
    </transition>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>
