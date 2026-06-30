import { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import axios from "axios";

export default function Dashboard() {
  const navigate = useNavigate();

  // State data user & data tugas
  const [userName, setUserName] = useState("Loading...");
  const [stats, setStats] = useState({ total: 0, completed: 0, pending: 0 });
  const [recentTasks, setRecentTasks] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const token = localStorage.getItem("token");

    // 1. PROTEKSI HALAMAN: Jika token tidak ada, tendang kembali ke login
    if (!token) {
      navigate("/");
      return;
    }

    // 2. AMBIL DATA DARI BACKEND
    const fetchDashboardData = async () => {
      try {
        // Ambil data user profile
        const userResponse = await axios.get(
          "http://127.0.0.1:8000/api/dashboard",
          {
            headers: { Authorization: `Bearer ${token}` },
          },
        );

        if (userResponse.data?.status === "success") {
          // Ambil nama dari user atau data tergantung kembalian DashboardController Anda
          setUserName(
            userResponse.data.user?.name ||
              userResponse.data.data?.name ||
              "User",
          );
        }

        // Ambil data statistik dan list tugas dari TaskController Anda
        const taskResponse = await axios.get(
          "http://127.0.0.1:8000/api/tasks",
          {
            headers: { Authorization: `Bearer ${token}` },
          },
        );

        if (taskResponse.data?.status === "success") {
          const taskData = taskResponse.data.data;

          // Set angka statistik jika disuplai backend, jika tidak hitung manual di frontend
          if (taskData.stats) {
            setStats(taskData.stats);
          } else {
            const list = taskData.tasks || taskData || [];
            const total = list.length;
            const completed = list.filter((t) => t.status === "done").length;
            setStats({ total, completed, pending: total - completed });
          }

          // Ambil 3 tugas teratas untuk dipajang di Recent Tasks
          const listAll = taskData.tasks || taskData || [];
          setRecentTasks(listAll.slice(0, 3));
        }
      } catch (error) {
        console.error("Gagal memuat data dashboard:", error);
        // Jika token kedaluwarsa, otomatis bersihkan dan minta login ulang
        if (error.response && error.response.status === 401) {
          handleLogout();
        }
      } finally {
        setLoading(false);
      }
    };

    fetchDashboardData();
  }, [navigate]);

  // Fungsi Logout
  const handleLogout = () => {
    localStorage.removeItem("token");
    navigate("/");
  };

  return (
    <div className="min-h-screen bg-[#0F0F23] text-white p-8">
      {/* Header */}
      <div className="flex justify-between items-start mb-10">
        <div>
          <h1 className="text-4xl font-bold text-purple-300">
            Welcome Back, {userName} 👋
          </h1>
          <p className="text-gray-400 mt-2">
            Stay productive and keep track of your academic progress.
          </p>
        </div>

        <button
          onClick={handleLogout}
          className="bg-red-500/20 border border-red-500/50 px-4 py-2 rounded-lg text-red-300 hover:bg-red-600 hover:text-white transition font-medium text-sm"
        >
          Logout
        </button>
      </div>

      {/* Navigation Menu */}
      <div className="flex gap-3 mb-8">
        <Link
          to="/tasks"
          className="bg-purple-500 px-4 py-2 rounded-lg hover:bg-purple-600 transition"
        >
          Tasks
        </Link>
        <Link
          to="/schedule"
          className="bg-purple-500 px-4 py-2 rounded-lg hover:bg-purple-600 transition"
        >
          Schedule
        </Link>
        <Link
          to="/holidays"
          className="bg-purple-500 px-4 py-2 rounded-lg hover:bg-purple-600 transition"
        >
          Holidays
        </Link>
      </div>

      {/* Stats Cards */}
      <div className="grid md:grid-cols-3 gap-6 mb-10">
        <div className="bg-[#1A1A35] p-6 rounded-xl border border-white/5">
          <h3 className="text-gray-400 mb-2">Total Tasks</h3>
          <p className="text-4xl font-bold text-purple-300">{stats.total}</p>
        </div>
        <div className="bg-[#1A1A35] p-6 rounded-xl border border-white/5">
          <h3 className="text-gray-400 mb-2">Completed</h3>
          <p className="text-4xl font-bold text-green-400">{stats.completed}</p>
        </div>
        <div className="bg-[#1A1A35] p-6 rounded-xl border border-white/5">
          <h3 className="text-gray-400 mb-2">Pending</h3>
          <p className="text-4xl font-bold text-yellow-400">{stats.pending}</p>
        </div>
      </div>

      {/* Recent Tasks */}
      <div className="bg-[#1A1A35] p-6 rounded-xl border border-white/5">
        <h2 className="text-2xl font-bold mb-5 text-purple-300">
          Recent Tasks
        </h2>

        {loading ? (
          <p className="text-gray-400 text-sm">Loading tasks...</p>
        ) : recentTasks.length === 0 ? (
          <p className="text-gray-500 text-sm italic">
            Belum ada tugas kuliah yang terdaftar.
          </p>
        ) : (
          <div className="space-y-4">
            {recentTasks.map((task) => (
              <div
                key={task.id}
                className="bg-[#0D0D1F] p-4 rounded-lg flex justify-between items-center border border-white/5"
              >
                <div>
                  <h4 className="font-medium text-white">{task.title}</h4>
                  <p className="text-xs text-gray-400 mt-1">
                    {task.description || "Tidak ada deskripsi"}
                  </p>
                </div>
                <span
                  className={`text-xs px-2 py-1 rounded-md font-semibold ${task.status === "done" ? "bg-green-500/10 text-green-400" : "bg-yellow-500/10 text-yellow-400"}`}
                >
                  {task.status.toUpperCase()}
                </span>
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}
