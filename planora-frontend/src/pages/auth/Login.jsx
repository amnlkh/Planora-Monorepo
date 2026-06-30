import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { loginUser } from "../../services/api";

export default function Login() {
  const navigate = useNavigate();

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");
    setLoading(true);

    try {
      const response = await loginUser({
        email,
        password,
      });

      console.log("Cek Respons API Login:", response);

      // SOLUSI: Ambil token dari segala kemungkinan struktur objek respons
      let token = null;
      if (response) {
        token =
          response.token || response.data?.token || response.data?.data?.token;
      }

      if (token) {
        // 1. Simpan token resmi ke localStorage browser
        localStorage.setItem("token", token);
        console.log("Token berhasil disimpan di localStorage!");

        // 2. Alihkan halaman ke dashboard
        navigate("/dashboard");
      } else {
        setError("Gagal masuk: Server tidak mengirimkan token autentikasi.");
      }
    } catch (err) {
      console.error("Error saat login:", err);
      if (err.response && err.response.data) {
        setError(err.response.data.message || "Email atau password salah.");
      } else {
        setError("Email atau password salah, silakan coba lagi.");
      }
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="min-h-screen bg-[#0F0F23] flex items-center justify-center px-4">
      <div className="bg-[#1A1A35] p-8 rounded-2xl w-full max-w-md shadow-xl border border-white/5">
        {/* Logo */}
        <div className="text-center mb-6">
          <h1 className="text-4xl font-bold text-purple-300">Planora</h1>
          <p className="text-gray-400 mt-2">Optimize your academic workflow</p>
        </div>

        {/* Menampilkan pesan error jika login gagal */}
        {error && (
          <div className="mb-4 p-3 bg-red-500/20 border border-red-500/50 rounded-lg text-red-300 text-sm text-center">
            {error}
          </div>
        )}

        {/* Login Form */}
        <form onSubmit={handleSubmit} className="space-y-4">
          <input
            type="email"
            placeholder="Email Address"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            className="w-full p-3 rounded-lg bg-[#0D0D1F] text-white border border-transparent focus:border-purple-500 outline-none"
            required
          />

          <input
            type="password"
            placeholder="Password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            className="w-full p-3 rounded-lg bg-[#0D0D1F] text-white border border-transparent focus:border-purple-500 outline-none"
            required
          />

          <button
            type="submit"
            disabled={loading}
            className="w-full bg-purple-500 hover:bg-purple-600 transition text-white p-3 rounded-lg font-semibold disabled:bg-purple-800"
          >
            {loading ? "Logging in..." : "Login"}
          </button>
        </form>

        {/* Divider */}
        <div className="flex items-center my-6">
          <div className="flex-1 h-px bg-gray-700"></div>
          <span className="px-3 text-gray-400 text-sm">OR</span>
          <div className="flex-1 h-px bg-gray-700"></div>
        </div>

        {/* Google Login */}
        <button
          type="button"
          onClick={() =>
            alert("Fitur login lewat Google sedang dalam pengembangan.")
          }
          className="w-full flex items-center justify-center gap-3 bg-white text-black p-3 rounded-lg font-medium hover:bg-gray-100 transition"
        >
          <img
            src="https://www.svgrepo.com/show/475656/google-color.svg"
            alt="Google"
            className="w-5 h-5"
          />
          Continue with Google
        </button>

        {/* Register Link */}
        <p className="text-gray-400 mt-6 text-center">
          Belum punya akun?{" "}
          <Link
            to="/register"
            className="text-purple-300 hover:text-purple-200 font-semibold"
          >
            Register
          </Link>
        </p>
      </div>
    </div>
  );
}
