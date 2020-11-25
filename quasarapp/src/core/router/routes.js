// Layouts
import LayoutWizard from 'core/layouts/LayoutWizard.vue'

import Wizard from 'core/pages/wizard/Index.vue'
import store from '../store'

const beforeEnter = (to, from, next) => {
  // console.log(store().state)
  if (store().state.token) {
    next({ path: '/' })
  } else {
    // console.log(to, from)
  }
  next()
}


const routes = [
  {
    path: '/',
    component: () => import('core/layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('core/pages/Index.vue') }
    ]
  },

  /*
  |--------------------------------------------------------------------------
  | Onboarding Routes
  |--------------------------------------------------------------------------|
 */
  {
    path: '/on-boarding',
    component: LayoutWizard,
    children: [
      {
        path: '/',
        component: Wizard,
        name: 'wizard'
      }
    ]
  }
]

// Always leave this as last one
if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('core/pages/Error404.vue')
  })
}

export default routes
