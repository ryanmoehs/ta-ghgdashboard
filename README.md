<h1>Tugas Akhir Dashboard GHG - Versi Laravel</h1>

Kenapa? Soalnya bapuk pake Flask.

Hal-hal yang harus diperhatikan kalau clone baru:

---

# Panduan Menjalankan Proyek Laravel dari GitHub  

## **Langkah 1: Clone Repository**  

### **1.1 Dapatkan URL Clone**  
- Buka halaman repository di GitHub.  
- Klik tombol hijau **"Code"**.  
- Salin URL HTTPS yang diberikan (jika SSH diaktifkan, bisa menggunakan SSH).  
- Contoh URLnya Repo ini:  
  ```
  https://github.com/RoneAllza/ta-ghgdashboard-laravelversion.git
  ```

### **1.2 Clone Repository ke Komputer Lokal**  
- Buka terminal atau Git Bash (Windows).  
- Arahkan ke direktori tempat proyek akan disimpan.  
- Jalankan perintah berikut untuk mengunduh repository:  
  ```
  git clone https://github.com/RoneAllza/ta-ghgdashboard-laravelversion.git
  ```  
- Jika ingin menentukan nama folder tujuan, tambahkan nama folder di akhir perintah:  
  ```
  git clone https://github.com/RoneAllza/ta-ghgdashboard-laravelversion.git nama-folder
  ```

---

## **Langkah 2: Menyiapkan Proyek Laravel**  

### **2.1 Masuk ke Direktori Proyek**  
Setelah cloning selesai, masuk ke folder proyek dengan perintah berikut:  
```
cd nama-folder
```

### **2.2 Install Dependensi**  
Laravel menggunakan **Composer** untuk mengelola dependensi. Jalankan perintah berikut untuk menginstalnya:  
```
composer install
```

### **2.3 Konfigurasi File .env**  
Laravel menggunakan file `.env` untuk menyimpan konfigurasi lingkungan seperti kredensial database. Jika file `.env` belum ada, buat dengan menyalin template-nya:  
```
cp .env.example .env
```

### **2.4 Generate Application Key**  
Laravel memerlukan application key untuk keperluan enkripsi dan sesi. Jalankan perintah berikut untuk membuatnya:  
```
php artisan key:generate
```
Perintah ini akan menghasilkan kunci acak dan memperbarui file `.env`.

### **2.5 Konfigurasi Database**  
- Buka file `.env` dengan teks editor.  
- Sesuaikan konfigurasi database sesuai kebutuhan:  
  ```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=nama_database
  DB_USERNAME=user_database
  DB_PASSWORD=password_database
  ```
- Pastikan database yang disebutkan dalam `.env` sudah ada, atau buat database baru.

---

## **Langkah 3: Menjalankan Migrasi Database**  
Jika proyek menggunakan database, jalankan migrasi untuk membuat tabel-tabel yang diperlukan:  
```
php artisan migrate
```
Untuk menambahkan data awal ke database, jalankan juga:  
```
php artisan db:seed
```

---

## **Langkah 4: Menjalankan Aplikasi Laravel**  
Setelah semua konfigurasi selesai, jalankan perintah berikut untuk memulai server pengembangan Laravel:  
```
php artisan serve
```
Setelah server berjalan, aplikasi bisa diakses melalui browser di alamat:  
```
http://localhost:8000
```

---

Dengan mengikuti langkah-langkah di atas, proyek Laravel siap digunakan. 🚀

# Selamat ngoding semoga beres sebelum Juni ^^

Kalo mau running kode pake frankenphp, ini caranya:
```
composer require laravel/octane
php artisan octane install
```
Terus pilih frankenphp (buat yang kupake, bisa eksplor yang lain sih tar)
```
php artisan octane:frankenphp --admin-port=2020
```
Udah hore. Entah kenapa pakai admin-port 2019 bapuk gabisa dipake jadinya gitu dah.
