import axios from "axios";

const api = axios.create({
    baseURL: 'http://localhost:8000/api/',
    responseType: "json",
    responseEncoding: "utf8",
    headers: {
      Authorization: `Bearer ${localStorage.getItem("token")}`,
      Accept: "application/json",
      "Content-Type": "application/json;charset=UTF-8",
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "GET,PUT,POST,DELETE,PATCH,OPTIONS",
    },
  });
  
  api.defaults.headers.common['Authorization'] =  true
  
  export default api;