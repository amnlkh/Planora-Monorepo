import axios from "axios";

const api = axios.create({
  // Mengambil URL dari .env, jika tidak ada/kosong akan otomatis memakai localhost (opsional)
  baseURL: import.meta.env.VITE_API_URL || "http://localhost:8000/api",
});

export default api;

// AUTH
export const loginUser = (data) => api.post("/login", data);

export const registerUser = (data) => api.post("/register", data);

// DASHBOARD
export const getDashboard = () => api.get("/dashboard");

// TASKS
export const getTasks = () => api.get("/tasks");

export const addTask = (data) => api.post("/tasks", data);

export const updateTask = (id, data) => api.put(`/tasks/${id}`, data);

export const deleteTask = (id) => api.delete(`/tasks/${id}`);

// HOLIDAYS
export const getHolidays = () => api.get("/holidays");

// SCHEDULES
export const getSchedules = () => api.get("/schedules");

export const addSchedule = (data) => api.post("/schedules", data);

export const deleteSchedule = (id) => api.delete(`/schedules/${id}`);
