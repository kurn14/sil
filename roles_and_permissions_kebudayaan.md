# Rekomendasi Role & Permission Sistem Layanan Balai Pelestarian Kebudayaan DIY

Berdasarkan dokumen `prd-kebudayaan.md`, sistem ini dikhususkan untuk pelestarian cagar budaya dan mencakup manajemen lokasi (Heritage Sites), penyewaan/penggunaan fasilitas (Facility Usage Requests), dan pelaporan kondisi fisik cagar budaya (Site Condition Reports).

Berikut adalah usulan struktur **Roles** dan **Permissions** yang ideal untuk diimplementasikan menggunakan `spatie/laravel-permission` dan **Filament PHP**.

---

## 1. Daftar Roles (Peran)

Berdasarkan bagian "Pengguna Sistem" di PRD, kita membutuhkan 4 Role utama:

1. **`super_admin`** (Administrator)
2. **`pengelola_situs`** (Staf Teknis / Juru Pelihara)
3. **`pimpinan`** (Kepala Balai Pelestarian)
4. **`pemohon`** (Pengunjung/Masyarakat yang sudah mendaftar akun untuk meminjam fasilitas)

---

## 2. Struktur Permissions (Hak Akses)

Pengelompokan permission berdasarkan Modul / Resource Filament yang sudah kita kerjakan:

### A. Modul Pengguna & Hak Akses (User Management)
- **Akses:** Khusus `super_admin`.
- **Permissions:** `view_any_user`, `view_user`, `create_user`, `update_user`, `delete_user`, `view_any_role`, `create_role`, `update_role`, `delete_role`, `assign_permission`.

### B. Modul Informasi Lokasi Cagar Budaya (Heritage Sites & Categories)
Menangani data master situs, kategori, foto galeri, titik koordinat, dan status renovasi.
- **Akses:** `super_admin`, `pengelola_situs`, `pimpinan` (Read-only).
- **Permissions:** 
  - `view_any_heritage_site`, `view_heritage_site` (Untuk Pimpinan & Pengelola)
  - `create_heritage_site`, `update_heritage_site`, `delete_heritage_site` (Untuk Pengelola & Admin)
  - `view_any_site_category`, `create_site_category`, `update_site_category`, `delete_site_category`
  - `upload_site_photo`

### C. Modul Permohonan Penggunaan Fasilitas (Facility Usage Requests)
Menangani peminjaman/sewa fasilitas (misal: syuting, upacara adat), surat permohonan, dan surat izin.
- **Akses:** `super_admin`, `pengelola_situs`, `pimpinan` (Read-only), `pemohon`.
- **Permissions untuk Pengelola Situs:**
  - `view_any_facility_usage_request`, `view_facility_usage_request`
  - `verify_facility_usage_request`, `approve_facility_usage_request`, `reject_facility_usage_request`
  - `issue_usage_permit` (Menerbitkan surat izin)
- **Permissions untuk Pemohon (Masyarakat):**
  - `view_own_facility_usage_request`, `create_own_facility_usage_request`
  - `upload_request_document`
  - `download_usage_permit` (Jika disetujui)

### D. Modul Registrasi & Pelaporan Kondisi (Site Condition Reports)
Menangani survei kondisi berkala, laporan kerusakan (rusak ringan/berat), dan riwayat pemeliharaan.
- **Akses:** `super_admin`, `pengelola_situs`, `pimpinan`.
- **Permissions:**
  - `view_any_site_condition_report`, `view_site_condition_report`
  - `create_site_condition_report`, `update_site_condition_report` (Untuk Pengelola saat survei)
  - `delete_site_condition_report` (Idealnya hanya Super Admin karena bersifat riwayat/log)
  - `review_damage_report` (Khusus `pimpinan` untuk merespon kerusakan berat 1x24 jam)

### E. Modul Dashboard & Laporan (Reporting)
- **Akses:** `pimpinan`, `pengelola_situs`, `super_admin`.
- **Permissions:**
  - `view_dashboard` (Widget akan disesuaikan per role)
  - `view_any_report`, `export_report_pdf`, `export_report_excel` (Rekap Penggunaan, Laporan Retribusi, Statistik Kunjungan).

---

## 3. Matriks Pemetaan Role vs Permission

| Modul/Tugas | Super Admin (Staf TI) | Pengelola Situs (Juru Pelihara) | Pimpinan (Kepala Balai) | Pemohon (Masyarakat) |
|---|:---:|:---:|:---:|:---:|
| **Manajemen Akun** | ✅ CRUD Penuh | ❌ | ❌ | ❌ |
| **Data Lokasi & Kategori** | ✅ CRUD Penuh | 🟨 Input & Edit Data/Foto | 👁️ Hanya Lihat | 👁️ Hanya Lihat di Peta Publik |
| **Permohonan Fasilitas** | ✅ CRUD Penuh | 🟨 Verifikasi & Setujui/Tolak | 👁️ Hanya Lihat (Rekap) | 🙋‍♂️ Ajukan & Pantau Milik Sendiri |
| **Laporan Kondisi Fisik** | ✅ CRUD Penuh | 🟨 Input Survei Berkala | 🟨 Review & Tindak Lanjut | ❌ |
| **Dashboard & Ekspor** | ✅ Semua | ✅ Statistik Teknis | ✅ Semua (Strategis) | ❌ |

---

## 4. Analisa & Rekomendasi Tambahan Sistem

1. **Role Pengelola Situs per Kategori/Lokasi:**
   Jika balai memiliki banyak juru pelihara, pertimbangkan fitur *scoped access* di mana seorang `pengelola_situs` hanya bisa mengedit/melaporkan kondisi untuk `HeritageSite` yang ditugaskan kepadanya.

2. **Pembatasan Hapus Data Laporan (Append-Only):**
   Sesuai aturan bisnis di PRD ("Riwayat kondisi situs tidak dapat dihapus"), permission `delete_site_condition_report` sebaiknya **tidak diberikan** kepada siapapun kecuali `super_admin` untuk keperluan maintenance IT murni.

3. **Status Transisi Pemohon:**
   Pemohon tidak dapat mengedit permohonan yang sudah beralih status ke `diverifikasi` atau `disetujui`. Anda bisa menggunakan `Gate` policy di Filament untuk menyembunyikan tombol Edit jika status bukan `diajukan`.
