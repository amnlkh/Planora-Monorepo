import { useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";

export default function Dashboard() {
  const navigate = useNavigate();

  // 1. LOGIKA PROTEKSI: Cek token setiap kali halaman dashboard dimuat
  useEffect(() => {
    const token = localStorage.getItem("token");

    // Jika tidak ada token di localStorage, tendang user kembali ke halaman login
    if (!token) {
      navigate("/");
    }
  }, [navigate]);

  // 2. FUNGSI LOGOUT: Hapus token dan kembali ke halaman utama
  const handleLogout = () => {
    localStorage.removeItem("token"); // Hapus token dari memory browser
    alert("Anda telah keluar.");
    navigate("/"); // Redirect ke halaman login
  };

  return (
    <div className="min-h-screen bg-[#0F0F23] text-white p-8">
      {/* Header & Tombol Logout */}
      <div className="flex justify-between items-start mb-10">
        <div>
          <h1 className="text-4xl font-bold text-purple-300">
            Welcome Back 👋
          </h1>
          <p className="text-gray-400 mt-2">
            Stay productive and keep track of your academic progress.
          </p>
        </div>

        {/* Tombol Logout Baru */}
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
        <div className="bg-[#1A1A35] p-6 rounded-xl">
          <h3 className="text-gray-400 mb-2">Total Tasks</h3>
          <p className="text-4xl font-bold text-purple-300">12</p>
        </div>

        <div className="bg-[#1A1A35] p-6 rounded-xl">
          <h3 className="text-gray-400 mb-2">Completed</h3>
          <p className="text-4xl font-bold text-green-400">8</p>
        </div>

        <div className="bg-[#1A1A35] p-6 rounded-xl">
          <h3 className="text-gray-400 mb-2">Pending</h3>
          <p className="text-4xl font-bold text-yellow-400">4</p>
        </div>
      </div>

      {/* Recent Tasks */}
      <div className="bg-[#1A1A35] p-6 rounded-xl">
        <h2 className="text-2xl font-bold mb-5 text-purple-300">
          Recent Tasks
        </h2>

        <div className="space-y-4">
          <div className="bg-[#0D0D1F] p-4 rounded-lg">
            Human Computer Interaction Essay
          </div>

          <div className="bg-[#0D0D1F] p-4 rounded-lg">
            Algorithm Lab Report
          </div>

          <div className="bg-[#0D0D1F] p-4 rounded-lg">Weekly Reading Quiz</div>
        </div>
      </div>
    </div>
  );
}
