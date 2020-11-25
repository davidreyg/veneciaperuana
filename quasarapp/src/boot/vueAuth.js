import authBearer from '@websanova/vue-auth/drivers/auth/bearer.js'
import httpAxios from '@websanova/vue-auth/drivers/http/axios.1.x.js'
import routerVueRouter from '@websanova/vue-auth/drivers/router/vue-router.2.x.js'
import VueAuth from '@websanova/vue-auth'

// "async" is optional;
// more info on params: https://quasar.dev/quasar-cli/cli-documentation/boot-files#Anatomy-of-a-boot-file
export default ({ Vue, router }) => {
  // something to do
  Vue.router = router
  Vue.use(VueAuth, {
    auth: authBearer,
    http: httpAxios,
    router: routerVueRouter,
    authRedirect: { path: '/auth' },
    rememberkey: 'auth_remember',
    tokenDefaultKey: 'token_API_FACTURACION',
    tokenImpersonateKey: 'auth_token_impersonate',
    stores: ['storage', 'cookie'],
    refreshData: {
      url: 'api/auth/refresh_token',
      method: 'POST',
      enabled: true,
      interval: 30
    },
    loginData: {
      url: 'api/auth/login',
      method: 'POST'
    },
    fetchData: {
      url: 'api/auth/user',
      method: 'GET'
    },
    logoutData: {
      url: 'api/auth/logout',
      method: 'GET'
    }
  })
}
