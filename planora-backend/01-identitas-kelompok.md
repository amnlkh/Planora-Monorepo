# Identitas Kelompok

---

**Nama Kelompok:** `Kelompok 7`

**Nama Proyek / Aplikasi:** `Planora`

**Jumlah Anggota:** `3 (tiga) orang`

**Repositori:** `https://github.com/amnlkh/Planora.git`
**Link web:** `https://planora-monorepo.vercel.app/`

---

## Anggota & Role

**Anggota 1**
- Nama Lengkap: `Khumaira Latifa`
- NIM: `230705107`
- Role: `Frontend Developer`
- Teknologi: `React, Tailwind CSS, Axios, Figma, Git`

**Anggota 2**
- Nama Lengkap: `M. Fais Musyarraf`
- NIM: `230705057`
- Role: `Backend Developer`
- Teknologi: `Laravel, MySQL, REST API`

**Anggota 3**
- Nama Lengkap: `Amnul`
- NIM: `230705118`
- Role: `DevOps Engineer`
- Teknologi: `Docker, GitHub, Railway`

---

## Stack Teknologi

**Frontend:** `React, Tailwind CSS, Axios`

*(Digunakan untuk membangun antarmuka pengguna dan berkomunikasi dengan backend melalui API.)*

**Backend:** `Laravel`

*(Framework backend utama untuk mengelola logika bisnis, autentikasi, dan API.)*

**Database:** `MySQL`

*(Digunakan untuk menyimpan data pengguna, tugas, dan informasi aplikasi.)*

**DevOps / Infrastruktur:** `Docker, GitHub, Railway`

*(Digunakan untuk version control, deployment, dan pengelolaan lingkungan aplikasi.)*

---

## Arsitektur Aplikasi

Planora menggunakan arsitektur client-server berbasis service-oriented architecture. Frontend dibangun menggunakan React dan berkomunikasi dengan backend Laravel melalui REST API. Backend bertugas mengelola autentikasi pengguna, data tugas, jadwal belajar, serta integrasi dengan layanan pihak ketiga. Seluruh data disimpan pada database MySQL dan deployment aplikasi dikelola menggunakan Docker serta GitHub.

### Aplikasi 1 — Frontend

- Nama Aplikasi: `Planora Frontend`
- Deskripsi Singkat: Antarmuka pengguna yang digunakan mahasiswa untuk mengelola tugas, melihat jadwal belajar, memantau progres tugas, dan mengakses informasi produktivitas.
- Berkomunikasi dengan: `Planora API Service`

### Aplikasi 3 — Backend (Laravel)

- Nama Aplikasi / Service: `Planora API Service`
- Deskripsi Singkat: Layanan backend berbasis Laravel yang menyediakan autentikasi pengguna, manajemen tugas, pengelolaan jadwal belajar, dashboard produktivitas, serta integrasi dengan API eksternal.
- Menyediakan layanan untuk: `Planora Frontend`
