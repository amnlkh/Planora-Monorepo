# Rencana Fitur

> Dokumentasikan minimal **5 fitur utama** proyek Anda.

---

## Fitur 1 — Autentikasi Pengguna

**Role Penanggung Jawab:** `Backend`

**Sumber Data:** `Internal System`

**Deskripsi & Ekspektasi:**

Fitur ini memungkinkan pengguna untuk melakukan registrasi akun, login, dan logout. Sistem akan memverifikasi data pengguna sebelum memberikan akses ke aplikasi. Tujuan fitur ini adalah memastikan setiap pengguna memiliki akun pribadi untuk mengelola tugas dan jadwal belajar mereka secara aman.

---

## Fitur 2 — Manajemen Tugas (Task Management)

**Role Penanggung Jawab:** `Frontend & Backend`

**Sumber Data:** `Internal System`

**Deskripsi & Ekspektasi:**

Pengguna dapat menambahkan, melihat, mengubah, dan menghapus tugas yang dimiliki. Setiap tugas memiliki informasi seperti judul, deskripsi, deadline, dan status pengerjaan. Fitur ini menjadi inti dari aplikasi Planora sebagai alat bantu pengelolaan tugas mahasiswa.

---

## Fitur 3 — Dashboard Produktivitas

**Role Penanggung Jawab:** `Frontend`

**Sumber Data:** `Internal System`

**Deskripsi & Ekspektasi:**

Dashboard menampilkan ringkasan aktivitas pengguna seperti jumlah tugas aktif, jumlah tugas selesai, serta deadline terdekat. Informasi ini membantu pengguna memantau progres belajar dan mengatur prioritas tugas dengan lebih baik.

---

## Fitur 4 — Jadwal Belajar dan Deadline

**Role Penanggung Jawab:** `Frontend & Backend`

**Sumber Data:** `Internal System`

**Deskripsi & Ekspektasi:**

Pengguna dapat mengatur jadwal belajar dan melihat daftar deadline tugas dalam bentuk kalender atau daftar agenda. Fitur ini membantu mahasiswa mengelola waktu belajar dan menghindari keterlambatan pengumpulan tugas.

---

## Fitur 5 — Informasi Hari Libur Nasional

**Role Penanggung Jawab:** `Backend`

**Sumber Data:** `Third-Party API — Nager.Date API`

**Deskripsi & Ekspektasi:**

Sistem akan mengambil data hari libur nasional Indonesia dari Nager.Date API dan menampilkannya pada aplikasi. Informasi ini membantu pengguna merencanakan jadwal belajar dan tugas berdasarkan kalender nasional yang berlaku.

API:
https://date.nager.at

GitHub:
https://github.com/nager/Nager.Date

Contoh Endpoint:
https://date.nager.at/api/v3/PublicHolidays/2026/ID

---