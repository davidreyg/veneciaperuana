import * as types from './mutation-types'
import {axiosBase} from '../../../../boot/axios';

export function uploadOnboardAvatar({ commit, dispatch, state }, data) {
  return new Promise((resolve, reject) => {
    axiosBase.post(`/api/admin/profile/upload-avatar`, data).then((response) => {
      commit(types.UPDATE_USER, response.data.user)
      resolve(response)
    }).catch((err) => {
      reject(err)
    })
  })
}
