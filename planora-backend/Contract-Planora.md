# Frontend-Backend Contract
## Planora - Student Productivity Management System

---

# Authentication

## Login

### Endpoint

POST /api/login

### Request

{
  "email": "khumairal1909@email.com",
  "password": "password123"
}

### Success Response

{
  "success": true,
  "token": "jwt_token",
  "user": {
    "id": 1,  
    "name": "Khumaira Latifa",
    "email": "khumairal1909@email.com"
  }
}

### Error Response

{
  "success": false,
  "message": "Invalid credentials"
}

### Frontend Usage

- Menampilkan form login
- Menyimpan token
- Redirect ke dashboard

---

## Register

### Endpoint

POST /api/register

### Request

{
  "name": "Khumaira Latifa",
  "email": "khumairal1909@email.com",
  "password": "password123"
}

### Success Response

{
  "success": true,
  "message": "Account created"
}

### Frontend Usage

- Menampilkan form registrasi
- Redirect ke halaman login

---

# Dashboard

## Get Dashboard Summary

### Endpoint

GET /api/dashboard

### Success Response

{
  "total_tasks": 12,
  "completed_tasks": 7,
  "pending_tasks": 5,
  "upcoming_deadlines": 3
}

### Frontend Usage

Dashboard Cards:
- Total Tasks
- Completed Tasks
- Pending Tasks
- Upcoming Deadlines

---

# Task Management

## Get All Tasks

### Endpoint

GET /api/tasks

### Success Response

{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Laporan PPL",
      "description": "Bab 1 dan Bab 2",
      "deadline": "2026-06-20",
      "priority": "high",
      "status": "pending"
    }
  ]
}

### Frontend Usage

Menampilkan daftar tugas.

---

## Create Task

### Endpoint

POST /api/tasks

### Request

{
  "title": "Laporan PPL",
  "description": "Bab 1 dan Bab 2",
  "deadline": "2026-06-20",
  "priority": "high"
}

### Success Response

{
  "success": true,
  "message": "Task created"
}

### Frontend Usage

Form tambah tugas.

---

## Update Task

### Endpoint

PUT /api/tasks/{id}

### Request

{
  "title": "Laporan PPL Revisi",
  "description": "Bab 1, 2, dan 3",
  "deadline": "2026-06-25",
  "priority": "medium",
  "status": "completed"
}

### Success Response

{
  "success": true,
  "message": "Task updated"
}

### Frontend Usage

Form edit tugas.

---

## Delete Task

### Endpoint

DELETE /api/tasks/{id}

### Success Response

{
  "success": true,
  "message": "Task deleted"
}

### Frontend Usage

Tombol hapus tugas.

---

# National Holidays

## Get Public Holidays

### Endpoint

GET /api/holidays

### Third Party API

https://date.nager.at/api/v3/PublicHolidays/2026/ID

### Success Response

{
  "success": true,
  "data": [
    {
      "date": "2026-08-17",
      "name": "Independence Day"
    }
  ]
}

### Frontend Usage

- Menampilkan hari libur nasional
- Ditampilkan pada halaman kalender

---

# Schedule Management

## Get All Schedules

### Endpoint

GET /api/schedules

### Request Parameters (Query String)

- `month` (optional, e.g., 6)
- `year` (optional, e.g., 2026)

### Success Response

```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "title": "Belajar Laravel",
      "date": "2026-06-20",
      "start_time": "09:00",
      "end_time": "11:00",
      "note": "Materi Service Provider",
      "created_at": "2026-06-15T07:00:00.000000Z",
      "updated_at": "2026-06-15T07:00:00.000000Z"
    }
  ]
}
```

### Frontend Usage

Menampilkan daftar jadwal belajar di kalender atau agenda.

---

## Create Schedule

### Endpoint

POST /api/schedules

### Request Body

```json
{
  "title": "Belajar Laravel",
  "date": "2026-06-20",
  "start_time": "09:00",
  "end_time": "11:00",
  "note": "Materi Service Provider"
}
```

### Success Response

```json
{
  "status": "success",
  "message": "Jadwal belajar berhasil ditambahkan",
  "data": {
    "id": 1,
    "user_id": 1,
    "title": "Belajar Laravel",
    "date": "2026-06-20",
    "start_time": "09:00",
    "end_time": "11:00",
    "note": "Materi Service Provider",
    "created_at": "2026-06-15T07:00:00.000000Z",
    "updated_at": "2026-06-15T07:00:00.000000Z"
  }
}
```

### Frontend Usage

Form tambah jadwal belajar.

---

## Delete Schedule

### Endpoint

DELETE /api/schedules/{id}

### Success Response

```json
{
  "status": "success",
  "message": "Jadwal belajar berhasil dihapus"
}
```

### Frontend Usage

Tombol hapus jadwal belajar.

---

# Frontend Pages Mapping

| Page | API |
|--------|--------|
| Login | POST /api/login |
| Register | POST /api/register |
| Dashboard | GET /api/dashboard |
| Task List | GET /api/tasks |
| Add Task | POST /api/tasks |
| Edit Task | PUT /api/tasks/{id} |
| Delete Task | DELETE /api/tasks/{id} |
| Calendar | GET /api/holidays |
| Schedule List | GET /api/schedules |
| Add Schedule | POST /api/schedules |
| Delete Schedule | DELETE /api/schedules/{id} |
