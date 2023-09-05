import axios from "axios";

const api = axios.create({
    baseURL: 'http://localhost:8000/api/',
    responseType: "json",
    responseEncoding: "utf8",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json;charset=UTF-8",
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "GET,PUT,POST,DELETE,PATCH,OPTIONS",
    },
  });

  api.interceptors.request.use((config) => {
    const token = localStorage.getItem('token')
  
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
  
    return config
  }, (err) => {
    return Promise.reject(err)
  })
  

  api.interceptors.response.use((response) => {
    return response
  }, (error) => {
    if (error.response.status === 401) {
      window.location = '#/login'
    }
  
    return Promise.reject(error)
  })
  
  api.defaults.headers.common['Authorization'] =  true

  export default api;