import axios from 'axios'
// const DEV_BASE_URL = 'http://127.0.0.1:4000'
// const PROD_BASE_URL = 'https://api.framework7.cn/mock_api'
const DEV_BASE_URL = 'http://app-api.yjqas.net/'
const PROD_BASE_URL = 'http://app-api.yjqas.net/'
//axios.defaults.timeout = 500
axios.defaults.baseURL = process.env.NODE_ENV === 'production' ? PROD_BASE_URL : DEV_BASE_URL
//axios.defaults.headers.common['Authorization'] = AUTH_TOKEN
axios.defaults.headers.post['Content-Type'] = 'application/json'
// Add a request interceptor
axios.interceptors.request.use(config => {
	return config
}, error => {
	return Promise.reject(error)
})

// Add a response interceptor 拦截器，直接返回data
axios.interceptors.response.use(response => {
	let data = response.data
	return !data.err_code ? data : Promise.reject(data)
}, error => {
	return Promise.reject(error)
})