// import something here
import Dinero from 'dinero.js'

// "async" is optional;
// more info on params: https://quasar.dev/quasar-cli/cli-documentation/boot-files#Anatomy-of-a-boot-file
export default ({ Vue }) => { // something to do
  Dinero.globalLocale = 'es-PE'
  Dinero.globalFormat = '$0,0.00'
  Dinero.defaultCurrency = 'PEN'
  Dinero.defaultPrecision = 2
  Vue.filter('formatMoney', function (val) {
    return Dinero({ amount: parseInt(val) }).toFormat()
  })
  Vue.prototype.Dinero = Dinero
}
