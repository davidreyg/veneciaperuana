import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

export const axiosBase = axios.create({
  baseURL: 'http://veneciaperuana.dev.com',
  withCredentials: true,
  headers: {
    // 'Accept': 'application/json',
    'Content-Type': 'application/json',
    // 'Access-Control-Allow-Credentials': true,
    // 'Access-Control-Allow-Origin': '*',
  }
});

Vue.use(VueAxios, axiosBase);
