# Tutorial Deployment Laravel ke Railway

## Persiapan Sebelum Deployment

### 1. Pastikan Repository Sudah di GitHub
```bash
git add .
git commit -m "Prepare for Railway deployment"
git push origin main
```

### 2. File Konfigurasi yang Sudah Dibuat
- `Procfile` - Untuk menjalankan aplikasi Laravel
- `railway.json` - Konfigurasi Railway
- `nixpacks.toml` - Konfigurasi build dan dependencies

## Langkah-langkah Deployment

### 1. Daftar di Railway
1. Kunjungi [railway.app](https://railway.app)
2. Sign up dengan GitHub account
3. Login ke dashboard Railway

### 2. Buat Project Baru
1. Klik "New Project"
2. Pilih "Deploy from GitHub repo"
3. Pilih repository proyek Laravel Anda
4. Klik "Deploy Now"

### 3. Setup Database MySQL
1. Di dashboard project, klik "New"
2. Pilih "Database" → "MySQL"
3. Tunggu sampai database terbuat
4. Catat connection string yang diberikan

### 4. Konfigurasi Environment Variables
1. Klik tab "Variables"
2. Tambahkan variable berikut:

```env
APP_NAME="Rewear App"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app-name.railway.app

# Database (akan otomatis terisi dari Railway)
DB_CONNECTION=mysql
DATABASE_URL=mysql://username:password@host:port/database

# Cache dan Session
BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Mail
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="Rewear App"

# Cloudinary (isi dengan kredensial Anda)
CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME

# Midtrans (isi dengan kredensial Anda)
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

### 5. Generate APP_KEY
1. Buka terminal di Railway dashboard
2. Jalankan: `php artisan key:generate`
3. Copy APP_KEY yang dihasilkan
4. Paste ke variable APP_KEY di Railway

### 6. Setup Database
1. Di terminal Railway, jalankan:
```bash
php artisan migrate
php artisan db:seed
```

### 7. Setup Storage
1. Jalankan di terminal Railway:
```bash
php artisan storage:link
```

### 8. Deploy Ulang
1. Klik "Deploy" di Railway dashboard
2. Tunggu proses build dan deploy selesai

## Troubleshooting

### Error Database Connection
- Pastikan DATABASE_URL sudah benar
- Cek apakah database MySQL sudah running
- Pastikan format DATABASE_URL: `mysql://username:password@host:port/database`

### Error 500
- Cek logs di Railway dashboard
- Pastikan APP_KEY sudah diset
- Cek apakah semua environment variables sudah benar

### Error File Permissions
- Railway menggunakan Linux, pastikan file permissions sudah benar
- Jalankan `chmod -R 755 storage bootstrap/cache` jika diperlukan

### Error Composer Dependencies
- Pastikan semua dependencies di composer.json sudah benar
- Cek apakah ada extension PHP yang missing

## Monitoring

### Logs
- Klik tab "Logs" di Railway dashboard untuk melihat real-time logs

### Metrics
- Railway menyediakan metrics CPU, memory, dan network usage

### Health Check
- Railway akan otomatis restart aplikasi jika health check gagal

## Custom Domain (Opsional)

1. Di Railway dashboard, klik "Settings"
2. Pilih "Domains"
3. Tambahkan custom domain Anda
4. Update DNS records sesuai instruksi Railway

## Backup Database

1. Di Railway dashboard, klik database service
2. Pilih "Backup" untuk membuat backup otomatis
3. Backup akan disimpan di Railway storage

## Scaling (Jika Diperlukan)

1. Di Railway dashboard, klik service
2. Pilih "Settings" → "Scaling"
3. Sesuaikan jumlah instances sesuai kebutuhan

## Cost Optimization

- Railway free tier: 500 jam/bulan
- Monitor usage di dashboard
- Hentikan service jika tidak digunakan untuk menghemat jam 