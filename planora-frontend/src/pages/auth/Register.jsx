import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import axios from "axios";

export default function Register() {
  // 1. Definisikan State untuk menangkap data dari input form
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [passwordConfirmation, setPasswordConfirmation] = useState("");
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  const navigate = useNavigate();

  // 2. Fungsi untuk menangani submit form ke Backend Laravel
  const handleRegister = async (e) => {
    e.preventDefault(); // Mencegah reload halaman otomatis
    setError("");
    setLoading(true);

    try {
      // Menembak endpoint register backend
      const response = await axios.post("http://127.0.0.1:8000/api/register", {
        name: name,
        email: email,
        password: password,
        password_confirmation: passwordConfirmation,
      });

      // Jika backend merespons dengan status success
      if (response.data.status === "success") {
        // =============== PERBAIKAN DI SINI ===============
        // Simpan token baru dari backend langsung ke localStorage browser
        if (response.data.token) {
          localStorage.setItem("token", response.data.token);
        }
        // =================================================

        alert("Registrasi Berhasil!");

        // Alihkan langsung ke dashboard karena user sudah otomatis memegang token akses resmi
        navigate("/dashboard");
      }
    } catch (err) {
      // Menangkap pesan error dari validasi Laravel jika ada
      if (err.response && err.response.data) {
        setError(
          err.response.data.message || "Terjadi kesalahan saat registrasi.",
        );
      } else {
        setError("Gagal terhubung ke server backend.");
      }
    } finally {
      setLoading(false);
    }
  };

  // 3. Fungsi sementara untuk tombol Google
  const handleGoogleRegister = () => {
    alert("Fitur pendaftaran lewat Google sedang dalam pengembangan.");
  };

  return (
    <div className="min-h-screen bg-[#0F0F23] flex items-center justify-center px-4">
      <div className="bg-[#1A1A35] p-8 rounded-2xl w-full max-w-md shadow-xl border border-white/5">
        {/* Logo */}
        <div className="text-center mb-6">
          <h1 className="text-4xl font-bold text-purple-300">Planora</h1>
          <p className="text-gray-400 mt-2">Create your student workspace</p>
        </div>

        {/* Menampilkan pesan error jika registrasi gagal */}
        {error && (
          <div className="mb-4 p-3 bg-red-500/20 border border-red-500/50 rounded-lg text-red-300 text-sm text-center">
            {error}
          </div>
        )}

        {/* Register Form */}
        <form onSubmit={handleRegister} className="space-y-4">
          <input
            type="text"
            placeholder="Full Name"
            value={name}
            onChange={(e) => setName(e.target.value)}
            className="w-full p-3 rounded-lg bg-[#0D0D1F] text-white border border-transparent focus:border-purple-500 outline-none"
            required
          />

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

          <input
            type="password"
            placeholder="Confirm Password"
            value={passwordConfirmation}
            onChange={(e) => setPasswordConfirmation(e.target.value)}
            className="w-full p-3 rounded-lg bg-[#0D0D1F] text-white border border-transparent focus:border-purple-500 outline-none"
            required
          />

          <button
            type="submit"
            disabled={loading}
            className="w-full bg-purple-500 hover:bg-purple-600 transition text-white p-3 rounded-lg font-semibold disabled:bg-purple-800"
          >
            {loading ? "Creating Account..." : "Create Account"}
          </button>
        </form>

        {/* Divider */}
        <div className="flex items-center my-6">
          <div className="flex-1 h-px bg-gray-700"></div>
          <span className="px-3 text-gray-400 text-sm">OR</span>
          <div className="flex-1 h-px bg-gray-700"></div>
        </div>

        {/* Google Register */}
        <button
          onClick={handleGoogleRegister}
          type="button"
          className="w-full flex items-center justify-center gap-3 bg-white text-black p-3 rounded-lg font-medium hover:bg-gray-100 transition"
        >
          <img
            src="https://www.svgrepo.com/show/475656/google-color.svg"
            alt="Google"
            className="w-5 h-5"
          />
          Continue with Google
        </button>

        {/* Login Link */}
        <p className="text-gray-400 mt-6 text-center">
          Already have an account?{" "}
          <Link
            to="/"
            className="text-purple-300 hover:text-purple-200 font-semibold"
          >
            Login
          </Link>
        </p>
      </div>
    </div>
  );
}
