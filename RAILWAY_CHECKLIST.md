# Railway Deployment Checklist

## ✅ File Konfigurasi yang Sudah Dibuat

- [x] `Procfile` - Untuk menjalankan aplikasi Laravel
- [x] `railway.json` - Konfigurasi Railway deployment
- [x] `nixpacks.toml` - Konfigurasi build dan dependencies PHP
- [x] `DEPLOYMENT.md` - Tutorial lengkap deployment
- [x] `deploy.sh` - Script deployment otomatis
- [x] `.gitignore` - Updated untuk Railway

## 🔧 Konfigurasi yang Sudah Diubah

- [x] Database default connection tetap MySQL (konsisten dengan development)
- [x] File konfigurasi untuk production environment
- [x] Ekstensi PHP untuk MySQL sudah dikonfigurasi

## 📋 Checklist Sebelum Deployment

### 1. Repository GitHub
- [ ] Repository sudah di GitHub
- [ ] Semua file sudah di-commit dan push
- [ ] Branch main/master sudah up-to-date

### 2. Environment Variables yang Perlu Disiapkan
- [ ] APP_KEY (akan di-generate di Railway)
- [ ] APP_URL (akan otomatis dari Railway)
- [ ] DATABASE_URL (akan otomatis dari Railway MySQL)
- [ ] CLOUDINARY_URL (kredensial Cloudinary Anda)
- [ ] MIDTRANS_SERVER_KEY (kredensial Midtrans Anda)
- [ ] MIDTRANS_CLIENT_KEY (kredensial Midtrans Anda)

### 3. Dependencies External
- [ ] Cloudinary account (untuk upload gambar)
- [ ] Midtrans account (untuk payment gateway)
- [ ] Email service (opsional, bisa menggunakan Mailpit)

## 🚀 Langkah Deployment

### Step 1: Railway Setup
- [ ] Daftar/Login ke Railway.app
- [ ] Buat project baru
- [ ] Connect ke GitHub repository

### Step 2: Database Setup
- [ ] Tambah MySQL service
- [ ] Catat DATABASE_URL
- [ ] Test koneksi database

### Step 3: Environment Variables
- [ ] Set APP_NAME="Rewear App"
- [ ] Set APP_ENV=production
- [ ] Set APP_DEBUG=false
- [ ] Set DB_CONNECTION=mysql
- [ ] Set semua variable lainnya

### Step 4: Deploy
- [ ] Trigger deployment pertama
- [ ] Monitor build process
- [ ] Cek logs jika ada error

### Step 5: Post-Deployment
- [ ] Generate APP_KEY di Railway terminal
- [ ] Jalankan `php artisan migrate`
- [ ] Jalankan `php artisan db:seed`
- [ ] Jalankan `php artisan storage:link`
- [ ] Test aplikasi di URL Railway

## 🔍 Troubleshooting Checklist

### Jika Build Gagal
- [ ] Cek logs di Railway dashboard
- [ ] Pastikan semua dependencies di composer.json
- [ ] Cek versi PHP di nixpacks.toml

### Jika Database Error
- [ ] Cek DATABASE_URL sudah benar
- [ ] Pastikan MySQL service running
- [ ] Test koneksi database
- [ ] Pastikan format: `mysql://username:password@host:port/database`

### Jika 500 Error
- [ ] Cek APP_KEY sudah diset
- [ ] Cek semua environment variables
- [ ] Cek file permissions storage dan bootstrap/cache

### Jika Upload File Error
- [ ] Pastikan CLOUDINARY_URL sudah benar
- [ ] Cek kredensial Cloudinary
- [ ] Test upload di local dulu

## 📊 Monitoring Checklist

### Setelah Deployment Berhasil
- [ ] Test semua fitur utama
- [ ] Test upload gambar
- [ ] Test payment gateway
- [ ] Test email (jika ada)
- [ ] Monitor performance di Railway dashboard

### Regular Maintenance
- [ ] Monitor logs secara berkala
- [ ] Cek usage metrics
- [ ] Backup database secara berkala
- [ ] Update dependencies jika diperlukan

## 💰 Cost Optimization

- [ ] Monitor usage di Railway dashboard
- [ ] Hentikan service jika tidak digunakan
- [ ] Optimize image sizes untuk menghemat bandwidth
- [ ] Gunakan caching untuk mengurangi database calls

## 🔗 Useful Links

- [Railway Dashboard](https://railway.app)
- [Railway Documentation](https://docs.railway.app)
- [Laravel Documentation](https://laravel.com/docs)
- [MySQL Documentation](https://dev.mysql.com/doc/)

## 📞 Support

Jika mengalami masalah:
1. Cek logs di Railway dashboard
2. Cek dokumentasi DEPLOYMENT.md
3. Cek troubleshooting section di DEPLOYMENT.md
4. Hubungi Railway support jika diperlukan 