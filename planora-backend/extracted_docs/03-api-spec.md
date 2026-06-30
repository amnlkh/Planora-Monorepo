# API Specification

> Dokumentasikan setiap endpoint yang dikembangkan maupun yang dikonsumsi dari layanan eksternal.
> Salin dan ulangi blok di bawah untuk setiap endpoint tambahan.

---

## [Nama Endpoint]

**Method:** `[GET | POST | PUT | DELETE]`

**URL:** `/api/v1/[resource]`

**Deskripsi:** `[Jelaskan fungsi endpoint ini]`

**Autentikasi Diperlukan:** `[Ya | Tidak]`

**Sumber:** `[Internal System | Third-Party API — nama layanan]`

**Request Headers:**
```
Authorization: Bearer <token>
Content-Type: application/json
```

**Request Body:**
```json
{
  "field": "tipe_data"
}
```

**Response Sukses (`200 OK`):**
```json
{
  "status": "success",
  "data": {}
}
```

**Response Gagal:**
```json
{
  "status": "error",
  "message": "[pesan kesalahan]"
}
```

---

## Contoh — Get Current Weather

**Method:** `GET`

**URL:** `/api/v1/weather`

**Deskripsi:** Mengambil data cuaca terkini berdasarkan nama kota yang dikirim sebagai query parameter, dikonsumsi dari OpenWeatherMap API.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Third-Party API — OpenWeatherMap`

**Request Headers:**
```
Authorization: Bearer <token>
Content-Type: application/json
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**
```json
{
  "status": "success",
  "data": {
    "city": "Banda Aceh",
    "temperature": 31,
    "condition": "Sunny",
    "humidity": 78
  }
}
```

**Response Gagal:**
```json
{
  "status": "error",
  "message": "City not found or API key invalid"
}
```

---

*(Salin blok template di atas untuk setiap endpoint selanjutnya)*

