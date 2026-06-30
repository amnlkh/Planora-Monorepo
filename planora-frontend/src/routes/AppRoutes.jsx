import { Routes, Route } from "react-router-dom";

import Login from "../pages/auth/Login";
import Register from "../pages/auth/Register";
import Dashboard from "../pages/dashboard/Dashboard";
import TaskList from "../pages/tasks/TaskList";
import ScheduleList from "../pages/schedules/ScheduleList";
import Holidays from "../pages/holidays/Holidays";

export default function AppRoutes() {
  return (
    <Routes>
      <Route path="/" element={<Login />} />
      <Route path="/register" element={<Register />} />
      <Route path="/dashboard" element={<Dashboard />} />
      <Route path="/tasks" element={<TaskList />} />
      <Route path="/schedule" element={<ScheduleList />} />
      <Route path="/holidays" element={<Holidays />} />
    </Routes>
  );
}