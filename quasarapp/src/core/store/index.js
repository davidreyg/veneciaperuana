import Vue from 'vue'
import Vuex from 'vuex'

import * as getters from './getters'
import mutations from './mutations.js'
import actions from './actions'

//ONBOARD
import userProfile from './onBoard/profileSetting'

Vue.use(Vuex)

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Store instance.
 */

export default function(/* { ssrContext } */) {
  const Store = new Vuex.Store({
    state: {
      isAppLoaded: false,
      token: localStorage.getItem('token_API_FACTURACION')
    },
    getters,
    mutations,
    actions,
    modules: {
      userProfile
    },

    // enable strict mode (adds overhead!)
    // for dev mode only
    strict: process.env.DEV
  })

  return Store
}
