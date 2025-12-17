# 📋 Sistem Manajemen Servis Rekanan

Aplikasi web modern untuk mengelola work order dan layanan servis dengan antarmuka yang intuitif dan responsif.

## ✨ Fitur Utama

- **Dashboard Modern** - Tampilan ringkas dengan statistik real-time
- **Manajemen Work Order** - Buat, edit, dan hapus work order dengan mudah
- **Filter Status** - Filter berdasarkan status (Sedang Diproses / Selesai)
- **Konfirmasi Dialog** - Menggunakan SweetAlert2 untuk konfirmasi aksi
- **Responsive Design** - Bekerja sempurna di desktop, tablet, dan mobile
- **Form Validation** - Validasi data real-time dengan pesan error yang jelas
- **Modern UI** - Tailwind CSS dengan gradient buttons dan animasi smooth

## 🛠️ Tech Stack

- **Backend**: Laravel 12+ (PHP)
- **Frontend**: Blade Template Engine
- **Styling**: Tailwind CSS 3 (CDN)
- **Alert Dialog**: SweetAlert2
- **Database**: MySQL/SQLite
- **Font**: Google Fonts (Poppins)

## 📦 Instalasi

### Requirement
- PHP 8.2+
- Composer
- MySQL/SQLite
- Node.js (optional, untuk development)

### Setup Awal

1. **Clone atau Extract Project**
```bash
cd bmc
```

2. **Install Dependencies**
```bash
composer install
```

3. **Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Setup**
```bash
php artisan migrate
```

5. **Jalankan Server**
```bash
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

## 📊 Struktur Database

### Tabel: work_orders

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | INT | Primary Key |
| no_work_order | STRING | Nomor WO (Unique) |
| nama | STRING | Nama Customer/Project |
| rekanan | STRING | Nama Rekanan/Supplier |
| barang | TEXT | Daftar Barang/Item |
| tanggal_service | DATE | Tanggal Service |
| status | ENUM | Sedang Diproses / Selesai |
| tanggal_selesai | DATE | Tanggal Selesai (nullable) |
| user_id | INT | FK ke Users |
| timestamps | DATETIME | Created & Updated At |

## 🎯 Fitur Detail

### Dashboard
- Menampilkan total WO, yang sedang diproses, dan yang sudah selesai
- Statistik real-time dengan card glassmorphism
- Header dengan gradient background yang menarik

### Form Tambah Work Order
- 5 field input (No WO, Nama, Rekanan, Tanggal Service, Barang)
- Validasi: No WO harus unik
- Pesan error yang jelas dan helpful
- Gradient button dengan hover effect

### Tabel Work Orders
- Menampilkan semua data WO dalam format tabel
- Sorting dan filtering berdasarkan status
- Badge status dengan warna berbeda
- Action buttons: Edit, Hapus, Tandai Selesai

### Modal Edit
- Modal overlay dengan backdrop blur
- Form pre-filled dengan data terpilih
- Button: Update dan Batal
- Smooth animation saat buka/tutup

### Konfirmasi Dialog
- Hapus WO: Warning dialog dengan emoji
- Tandai Selesai: Question dialog dengan konfirmasi
- SweetAlert2 custom styling

## 🚀 Cara Menggunakan

### Membuat Work Order Baru
1. Isi form di bagian "Tambah Work Order Baru"
2. Pastikan No Work Order belum ada (unik)
3. Klik tombol "✨ Simpan Work Order"
4. Status otomatis "Sedang Diproses"

### Mengedit Work Order
1. Klik tombol "✏️ Edit" di baris yang ingin diubah
2. Modal akan terbuka dengan data terpilih
3. Ubah data sesuai kebutuhan
4. Klik "💾 Update" untuk simpan

### Menyelesaikan Work Order
1. Klik tombol "✓ Selesai" di baris WO
2. Konfirmasi di dialog yang muncul
3. Status berubah menjadi "Selesai"
4. Tanggal Selesai otomatis terisi

### Menghapus Work Order
1. Klik tombol "🗑️ Hapus" di baris WO
2. Konfirmasi penghapusan di dialog
3. Data akan dihapus dari database

### Filter by Status
- **Semua**: Tampilkan semua work order
- **Sedang Diproses**: Hanya yang belum selesai
- **Sudah Selesai**: Hanya yang sudah selesai

## 🎨 Styling & Desain

### Warna Palette
- **Primary**: #667eea (Indigo)
- **Secondary**: #764ba2 (Purple)
- **Success**: #22c55e (Green)
- **Warning**: #f59e0b (Amber)
- **Error**: #ef4444 (Red)
- **Background**: #f9fafb (Gray)

### Komponen UI
- **Gradient Buttons**: Linear gradient dari indigo ke purple
- **Card Hover**: Translate Y -8px dengan shadow effect
- **Input Focus**: Border indigo dengan box-shadow
- **Table Row Hover**: Gradient background dengan inset shadow
- **Modal Overlay**: Fade in animation dengan backdrop blur
- **Badge Status**: Rounded pill dengan custom color
- **Animations**: Smooth transitions (0.3s - 0.4s)

## 📱 Responsive Design

- **Mobile (< 768px)**: Single column layout, optimized touch targets
- **Tablet (768px - 1024px)**: 2 column grid, balanced spacing
- **Desktop (> 1024px)**: 3 column grid, full features

## 🔒 Validasi & Error Handling

### Form Validation
- No Work Order: Required, Unique, String
- Nama: Required, String, Max 255
- Rekanan: Required, String, Max 255
- Tanggal Service: Required, Date
- Barang: Required, String, Max 1000

### Error Messages
- Ditampilkan dalam SweetAlert2 error dialog
- List error berformat bullet points
- Field validation error di bawah input

## 🐛 Troubleshooting

### Database Error
```bash
php artisan migrate:refresh
php artisan migrate:status
```

### Cache Issues
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Permissions Error
```bash
chmod -R 775 storage bootstrap/cache
```

## 📝 License

MIT License - Feel free to use untuk project pribadi atau komersial.

## 👨‍💻 Author

Sistem Manajemen Servis Rekanan
Dibangun dengan ❤️ menggunakan Laravel & Tailwind CSS

---

**Last Updated**: December 17, 2025
**Version**: 1.0.0
