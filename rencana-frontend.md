# Rencana Aksi: Frontend Publik — Livewire 4 + Tailwind CSS 4

> Berdasarkan [prd-kebudayaan.md](file:///Users/kurnia/www/sil/prd-kebudayaan.md)

---

## Ringkasan

Frontend publik ini adalah **halaman terpisah dari panel admin Filament**, ditujukan untuk **Pengunjung (Publik)** — masyarakat umum, wisatawan, dan peneliti. Halaman ini dibangun menggunakan **Livewire 4** (sudah bundled di Laravel 13) dan **Tailwind CSS 4** (sudah terinstal via Vite).

---

## Fase 1 — Persiapan Infrastruktur

### 1.1 Instalasi Livewire 4

```bash
composer require livewire/livewire:^4.0
```

### 1.2 Buat Layout Blade Utama

Buat file `resources/views/components/layouts/app.blade.php` sebagai layout utama halaman publik (terpisah dari Filament). Layout ini memuat:
- Tailwind CSS 4 (via `@vite`)
- Livewire styles & scripts (`@livewireStyles`, `@livewireScripts`)
- Leaflet.js CDN (untuk peta interaktif)
- Google Fonts (Inter / Outfit)
- Navbar publik + Footer

### 1.3 Konfigurasi Routing

Update `routes/web.php` untuk mendefinisikan rute halaman publik:

| Route | Komponen Livewire | Deskripsi |
|---|---|---|
| `/` | `pages.home` | Landing page / beranda |
| `/heritage-sites` | `pages.heritage-site-index` | Katalog daftar situs + peta |
| `/heritage-sites/{slug}` | `pages.heritage-site-detail` | Detail situs (galeri, deskripsi, peta) |

> **Catatan:** Halaman permohonan penggunaan fasilitas dan pengecekan status permohonan **tidak dibuat di frontend publik**. Fitur tersebut ditangani sepenuhnya melalui **panel admin Filament** (`/admin`). Pemohon (role `pemohon`) login ke Filament dan mengakses resource `FacilityUsageRequest` yang sudah dibatasi oleh Policy agar hanya melihat data miliknya sendiri.

---

## Fase 2 — Halaman & Komponen Livewire

### 2.1 Landing Page (`/`)

**File:** `app/Livewire/Pages/Home.php` + `resources/views/livewire/pages/home.blade.php`

**Konten:**
- Hero section dengan foto cagar budaya (full-width, gradient overlay)
- Statistik ringkas (jumlah situs, jumlah kategori) — query dari `HeritageSite::count()`
- Preview 6 situs populer (card grid) — ambil dari `HeritageSite` dengan foto pertama
- Peta mini interaktif (Leaflet) menampilkan semua marker lokasi
- CTA (Call-to-Action): "Jelajahi Semua Situs" → link ke `/heritage-sites`
- CTA: "Ajukan Permohonan Fasilitas" → link ke `/facility-request`

### 2.2 Katalog Situs Cagar Budaya (`/heritage-sites`)

**File:** `app/Livewire/Pages/HeritageSiteIndex.php`

**Fitur Livewire (reaktif, tanpa reload):**
- **Pencarian** (`$search`) — filter nama situs secara real-time
- **Filter Kategori** (`$categoryId`) — dropdown/tabs berdasarkan `SiteCategory`
- **Filter Status** (`$status`) — `active`, `under_renovation`, `temporarily_closed`
- **Toggle tampilan** — Grid (card) vs. Peta (fullscreen Leaflet map)
- **Pagination** — lazy load / infinite scroll

**Tampilan Card:**
- Foto thumbnail, nama situs, kategori (badge), status (badge warna), alamat singkat
- Klik → navigasi ke halaman detail

**Tampilan Peta:**
- Leaflet.js fullscreen dengan semua marker
- Klik marker → popup ringkas (nama, foto kecil, link detail)
- Marker berbeda warna/ikon sesuai kategori

### 2.3 Detail Situs (`/heritage-sites/{slug}`)

**File:** `app/Livewire/Pages/HeritageSiteDetail.php`

**Konten:**
- Galeri foto (carousel/lightbox) — dari relasi `SitePhoto`
- Informasi lengkap: nama, deskripsi, alamat, jam operasional, status
- Badge kategori + status (aktif / renovasi / tutup)
- Nomor registrasi cagar budaya + tahun penetapan
- Peta lokasi tunggal (Leaflet, centered pada koordinat situs)
- Tombol CTA: "Ajukan Penggunaan Fasilitas Ini" → link ke `/facility-request?site={id}`
- Situs terkait (rekomendasi situs lain dalam kategori yang sama)

### 2.4 Permohonan Penggunaan Fasilitas (via Panel Applicant Filament)

> **Fitur ini TIDAK dibuat di frontend Livewire.** Permohonan ditangani melalui **panel Filament tersendiri** khusus untuk pemohon.

Pemohon (masyarakat) login ke `/applicant` (panel terpisah dari `/admin`), lalu mengakses resource `FacilityUsageRequest`. Panel ini diatur menggunakan sistem **Multi-Auth**, yang berarti pemohon memiliki tabel databasenya sendiri (tidak bercampur dengan tabel `users` admin).

**Arsitektur Multi-Panel & Multi-Auth Filament:**

| Panel | Path | Tabel DB | Guard | Menu yang Tampil |
|---|---|---|---|---|
| **Admin Panel** | `/admin` | `users` | `web` | Semua resource (Users, Roles, Heritage Sites, dll) |
| **Panel Applicant** | `/applicant` | `applicants` | `applicant` | Hanya: Permohonan Saya, Profil Saya |

**Yang perlu dibuat:**
1. Buat Model & Migration `Applicant` (Tabel `applicants` dengan kolom nama, email, password, dll)
2. Daftarkan auth guard baru `applicant` di `config/auth.php` yang mengarah ke provider tabel `applicants`
3. Buat `ApplicantPanelProvider.php` di `app/Providers/Filament/` dan set `authGuard('applicant')`
4. Daftarkan resource `FacilityUsageRequest` khusus untuk panel applicant
5. Update migration `FacilityUsageRequest` untuk mengubah relasi dari `user_id` menjadi `applicant_id`
6. Aktifkan fitur **registrasi** di panel applicant (`->registration()`) agar masyarakat bisa mendaftar sendiri dan tersimpan di tabel `applicants`
7. Tambahkan tombol CTA di halaman detail situs publik yang mengarahkan ke `/applicant/facility-usage-requests/create?site={id}`

---

## Fase 3 — Komponen Livewire Reusable

Komponen kecil yang dipakai di banyak halaman:

| Komponen | Lokasi | Kegunaan |
|---|---|---|
| `LeafletMap` | `app/Livewire/Components/LeafletMap.php` | Peta Leaflet.js reusable, menerima array markers via props |
| `SiteCard` | Blade component (non-Livewire) | Card tampilan situs (foto, nama, kategori, status) |
| `CategoryFilter` | `app/Livewire/Components/CategoryFilter.php` | Tabs/pills filter kategori situs |
| `PhotoGallery` | Blade component (non-Livewire) | Lightbox galeri foto untuk halaman detail |
| `StatusBadge` | Blade component (non-Livewire) | Badge status dengan warna kontekstual |

---

## Fase 4 — Panel Applicant (Multi-Auth Filament)

Karena pemohon dipisah tabelnya, kita perlu melakukan setup Multi-Auth sebelum membuat panel.

### 4.1 Setup Database & Auth Guard

```bash
php artisan make:model Applicant -m
```
- Buat kolom standard untuk autentikasi di migration `applicants`
- Update `config/auth.php` untuk menambahkan guard `applicant` dan provider `applicants`
- Update tabel `facility_usage_requests` untuk mengubah relasi ke `applicant_id`

### 4.2 Buat Panel Applicant

```bash
php artisan make:filament-panel applicant
```

File yang dihasilkan: `app/Providers/Filament/ApplicantPanelProvider.php`

### 4.3 Konfigurasi Panel Applicant

```php
// ApplicantPanelProvider.php
$panel
    ->id('applicant')
    ->path('applicant')              // URL: /applicant
    ->login()                       // Halaman login
    ->registration()                // Halaman registrasi mandiri
    ->authGuard('applicant')        // Menggunakan guard khusus
    ->colors(['primary' => Color::Teal])
    ->discoverResources(...)        // Hanya resource untuk applicant
```

### 4.4 Resource Khusus Panel Applicant

Buat resource terpisah di folder `app/Filament/Applicant/Resources/`:
- `MyFacilityRequestResource` — CRUD permohonan milik sendiri
- `MyProfileResource` — Edit profil pemohon

### 4.5 Middleware

- Halaman `/`, `/heritage-sites`, `/heritage-sites/{slug}` → **tanpa auth** (publik, Livewire)
- Halaman `/admin/*` → **Filament auth (web guard)**
- Halaman `/applicant/*` → **Filament auth (applicant guard)**

---

## Fase 5 — Integrasi Peta Interaktif (Leaflet.js)

### 5.1 Setup

- Load Leaflet CSS + JS via CDN di layout
- Buat Alpine.js component (`x-data="leafletMap"`) untuk inisialisasi peta
- Komunikasi Livewire → Alpine via `@entangle` atau `$dispatch`

### 5.2 Data Flow

```
HeritageSite (Eloquent) 
  → Livewire Component (query + format JSON) 
    → Blade (pass ke Alpine via @entangle / @json) 
      → Leaflet.js (render markers di peta)
```

### 5.3 Fitur Peta

- Marker per situs dengan popup (nama + foto kecil + link detail)
- Marker clustering (jika banyak titik berdekatan)
- Filter kategori → update markers secara reaktif (Livewire re-render)
- Fullscreen toggle

---

## Fase 6 — Multi-Bahasa (i18n)

Karena sistem sudah menggunakan `spatie/laravel-translatable` dan `bezhansalleh/filament-language-switch`:
- Halaman publik akan membaca locale dari session/URL
- Teks statis menggunakan `__('key')` dengan file `lang/id.json` dan `lang/en.json`
- Data dinamis (nama situs, deskripsi) otomatis menggunakan locale aktif via `HasTranslations` trait

---

## Struktur File yang Akan Dibuat

```
app/Livewire/
├── Pages/
│   ├── Home.php
│   ├── HeritageSiteIndex.php
│   └── HeritageSiteDetail.php
└── Components/
    ├── LeafletMap.php
    └── CategoryFilter.php

resources/views/
├── components/
│   └── layouts/
│       └── app.blade.php          ← Layout publik utama
├── livewire/
│   ├── pages/
│   │   ├── home.blade.php
│   │   ├── heritage-site-index.blade.php
│   │   └── heritage-site-detail.blade.php
│   └── components/
│       ├── leaflet-map.blade.php
│       └── category-filter.blade.php
└── components/                    ← Blade components (non-Livewire)
    ├── site-card.blade.php
    ├── photo-gallery.blade.php
    └── status-badge.blade.php

routes/
└── web.php                        ← Rute publik ditambahkan di sini
```

---

## Urutan Pengerjaan (Prioritas)

| # | Task | Estimasi | Prioritas |
|---|---|---|---|
| 1 | Install Livewire 4 + Setup layout + routing | 1 jam | 🔴 Tinggi |
| 2 | Landing Page (Home) | 2 jam | 🔴 Tinggi |
| 3 | Katalog Situs + Filter + Peta Interaktif | 4 jam | 🔴 Tinggi |
| 4 | Detail Situs + Galeri Foto | 2 jam | 🔴 Tinggi |
| 5 | Integrasi Leaflet.js (Map component) | 3 jam | 🔴 Tinggi |
| 6 | Setup Multi-Auth (Tabel Applicant, Guard) & Update Relasi | 2 jam | 🔴 Tinggi |
| 7 | Buat Panel Applicant (ApplicantPanelProvider) | 2 jam | 🟡 Sedang |
| 8 | Resource khusus applicant (MyFacilityRequest, MyProfile) | 3 jam | 🟡 Sedang |
| 9 | Multi-bahasa di halaman publik | 1 jam | 🟢 Rendah |
| 10 | Polish UI (animasi, responsif, dark mode) | 2 jam | 🟢 Rendah |

**Total estimasi: ~22 jam kerja**

---

## Open Questions

1. **Desain**: Apakah ada referensi desain/website yang Anda sukai untuk dijadikan acuan tampilan frontend publik?
2. **Domain**: Apakah frontend publik dan admin panel akan berada di domain yang sama (misal: `sil.go.id` untuk publik, `sil.go.id/admin` untuk admin, `sil.go.id/applicant` untuk applicant)?
