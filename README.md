# 🏢 D'Botanica MOD Damage Report

### Perangkat Lunak Pelaporan Temuan Kerusakan Area Mall D'Botanica

> **Web-based damage reporting system** untuk membantu Manager On Duty (MOD) dalam mencatat, memantau, dan mengelola temuan kerusakan fasilitas di area Mall D'Botanica secara terstruktur dan terdokumentasi.

---

## 📌 Tentang Proyek

**D'Botanica MOD Damage Report** merupakan aplikasi berbasis web yang dikembangkan untuk mendigitalisasi proses pelaporan temuan kerusakan yang sebelumnya dapat dilakukan secara manual.

Aplikasi ini membantu **Manager On Duty (MOD) dan administrator** dalam mengelola laporan kerusakan mulai dari pencatatan temuan, proses perbaikan, hingga penyelesaian kerusakan.

Dengan adanya sistem ini, proses monitoring menjadi lebih **terstruktur, terdokumentasi, dan mudah ditelusuri**.

---

## 🎯 Tujuan

Aplikasi ini dikembangkan untuk:

* 📝 Mencatat temuan kerusakan secara digital.
* 🔧 Memantau proses perbaikan kerusakan.
* 📊 Menampilkan data dan status laporan secara terstruktur.
* 👥 Mengelola data user dan divisi.
* 📄 Menghasilkan laporan kerusakan yang dapat diunduh.
* ⏱️ Membantu meningkatkan efisiensi proses monitoring kerusakan.

---

## ✨ Fitur Utama

| Fitur                      | Deskripsi                                                  |
| -------------------------- | ---------------------------------------------------------- |
| 🔐 **Login Admin**         | Autentikasi pengguna untuk mengakses sistem                |
| 📊 **Dashboard**           | Menampilkan ringkasan data dan status kerusakan            |
| 🏢 **Master Divisi**       | Mengelola data divisi yang terlibat dalam proses perbaikan |
| 👤 **Master User**         | Mengelola data pengguna sistem                             |
| ⚠️ **Temuan Kerusakan**    | Mencatat dan mengelola temuan kerusakan                    |
| 🔧 **Perbaikan Kerusakan** | Memantau proses perbaikan berdasarkan laporan              |
| ✅ **Selesai Perbaikan**    | Menampilkan laporan kerusakan yang telah diselesaikan      |
| 📥 **Unduh Laporan**       | Mengunduh data laporan kerusakan untuk dokumentasi         |

---

## 🔄 Alur Sistem

```text
        ┌─────────────────┐
        │   Login Admin   │
        └────────┬────────┘
                 ↓
        ┌─────────────────┐
        │    Dashboard    │
        └────────┬────────┘
                 ↓
        ┌─────────────────┐
        │ Temuan Kerusakan│
        └────────┬────────┘
                 ↓
        ┌─────────────────┐
        │    Perbaikan    │
        └────────┬────────┘
                 ↓
        ┌─────────────────┐
        │ Selesai Diperbaiki│
        └────────┬────────┘
                 ↓
        ┌─────────────────┐
        │ Unduh Laporan   │
        └─────────────────┘
```

---

## 🛠️ Tech Stack

### Backend

![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?style=for-the-badge\&logo=laravel\&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8+-777BB4?style=for-the-badge\&logo=php\&logoColor=white)

### Database

![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge\&logo=mysql\&logoColor=white)

### Frontend & UI

![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge\&logo=html5\&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge\&logo=css3\&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-Framework-7952B3?style=for-the-badge\&logo=bootstrap\&logoColor=white)
![AdminLTE](https://img.shields.io/badge/AdminLTE-Template-3C8DBC?style=for-the-badge)

### Development Tools

![VS Code](https://img.shields.io/badge/VS%20Code-Editor-007ACC?style=for-the-badge\&logo=visual-studio-code\&logoColor=white)
![Git](https://img.shields.io/badge/Git-Version%20Control-F05032?style=for-the-badge\&logo=git\&logoColor=white)
![GitHub](https://img.shields.io/badge/GitHub-Repository-181717?style=for-the-badge\&logo=github\&logoColor=white)

---

# 🖥️ System Preview

## 🔐 Login Admin

Halaman autentikasi untuk membatasi akses ke dalam sistem.

![Login Admin](img/Login.png)

---

## 📊 Dashboard Admin

Dashboard memberikan gambaran umum mengenai data dan status laporan kerusakan.

![Dashboard Admin](img/Dashboard%20Admin.png)

---

## 🏢 Data Master Divisi

Digunakan untuk mengelola data divisi yang terkait dengan proses penanganan kerusakan.

![Data Master Divisi](img/Data%20Master%20Divisi.png)

---

## 👤 Data Master User

Digunakan untuk mengelola pengguna yang memiliki akses terhadap sistem.

![Data Master User](img/Data%20Master%20User.png)

---

## ⚠️ Temuan Kerusakan

Halaman untuk mencatat dan mengelola temuan kerusakan yang ditemukan di area mall.

![Temuan Kerusakan](img/Temuan%20Kerusakan.png)

---

## 🔧 Perbaikan Kerusakan

Menampilkan proses penanganan dan perbaikan terhadap kerusakan yang telah dilaporkan.

![Perbaikan Kerusakan](img/Perbaikan%20Kerusakan.png)

---

## ✅ Selesai Perbaikan

Menampilkan data kerusakan yang telah selesai ditangani.

![Selesai Perbaikan](img/Selesai%20Perbaikan.png)

---

## 📥 Unduh Laporan Kerusakan

Fitur untuk menghasilkan dan mengunduh laporan kerusakan sebagai dokumentasi.

![Unduh Laporan Kerusakan](img/Unduh%20Laporan%20Kerusakan.png)

---

# 🚀 Installation

Ikuti langkah berikut untuk menjalankan project secara lokal.

### 1. Clone Repository

```bash
git clone https://github.com/putri-suci-aliyah/dbotanica-mod-damage-report.git
```

### 2. Masuk ke Folder Project

```bash
cd dbotanica-mod-damage-report
```

### 3. Install Dependency

```bash
composer install
```

### 4. Copy Environment File

```bash
cp .env.example .env
```

Untuk Windows:

```bash
copy .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Buat database MySQL, kemudian sesuaikan konfigurasi pada file `.env`.

```env
DB_DATABASE=[nama_database]
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Jalankan Migration

```bash
php artisan migrate
```

Jika project menggunakan seeder:

```bash
php artisan db:seed
```

### 8. Jalankan Laravel

```bash
php artisan serve
```

Kemudian buka:

```text
http://127.0.0.1:8000
```

---

# 📂 Project Structure

Struktur utama aplikasi menggunakan konsep **MVC (Model-View-Controller)** dari Laravel.

```text
dbotanica-mod-damage-report/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   │
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   └── img/
│
├── resources/
│   └── views/
│
├── routes/
│   └── web.php
│
├── .env.example
├── composer.json
└── README.md
```

---

# 👩‍💻 Role & Contribution

**Role:** Full-Stack Web Developer

### Responsibilities

* Menganalisis kebutuhan sistem pelaporan kerusakan.
* Merancang struktur database MySQL.
* Mengembangkan backend menggunakan Laravel 10.
* Mengembangkan tampilan antarmuka menggunakan AdminLTE.
* Mengimplementasikan CRUD data master.
* Mengembangkan proses pencatatan dan monitoring kerusakan.
* Mengimplementasikan proses status perbaikan.
* Mengembangkan fitur laporan dan download data.
* Melakukan testing dan debugging aplikasi.

---

# 📈 Future Development

Beberapa pengembangan yang dapat dilakukan pada versi berikutnya:

* 🔔 Notifikasi ketika terdapat laporan kerusakan baru.
* 📱 Responsive interface untuk perangkat mobile.
* 📊 Statistik dan visualisasi laporan kerusakan yang lebih lengkap.
* 👥 Role-based access control untuk berbagai jenis pengguna.
* 📷 Upload foto sebagai bukti kondisi kerusakan.
* 🔎 Advanced search dan filtering laporan.
* 📧 Notifikasi melalui email atau WhatsApp.
* 📋 Audit trail untuk mencatat aktivitas pengguna.

---

# 📄 Project Information

| Informasi                | Detail                       |
| ------------------------ | ---------------------------- |
| **Project**              | D'Botanica MOD Damage Report |
| **Type**                 | Web Application              |
| **Framework**            | Laravel 10                   |
| **Programming Language** | PHP                          |
| **Database**             | MySQL                        |
| **UI Template**          | AdminLTE                     |
| **Architecture**         | MVC                          |
| **Platform**             | Web                          |
| **Development Role**     | Full-Stack Web Developer     |

---

## ⭐ Project Highlights

> **Digitalisasi proses pelaporan kerusakan fasilitas** dari pencatatan temuan hingga penyelesaian perbaikan dalam satu sistem terintegrasi.

**Key Value:**

`Digital Reporting` · `Damage Monitoring` · `Data Management` · `Reporting` · `Laravel MVC`

---

## 📬 Contact

Jika ingin berdiskusi mengenai project ini atau peluang kolaborasi, silakan hubungi saya melalui GitHub.

**Developed by Suci Aliyah Putri**
*Informatics Student | Web Developer*
