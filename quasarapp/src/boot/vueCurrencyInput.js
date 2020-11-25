// import something here
import VueCurrencyInput from 'vue-currency-input'
// "async" is optional;
// more info on params: https://quasar.dev/quasar-cli/cli-documentation/boot-files#Anatomy-of-a-boot-file
export default async ({ Vue }) => {
  const pluginOptions = {
    /* see config reference */
    globalOptions: {
      currency: 'PEN',
      locale: 'es-PE',
      autoDecimalMode: true,
      precision: 2,
      valueAsInteger: true,
      distractionFree: true
    }
  }
  Vue.use(VueCurrencyInput, pluginOptions)
}
