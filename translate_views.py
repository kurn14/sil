import os
import json

replacements = {
    'resources/views/components/leaflet-map.blade.php': [
        ('Lihat Detail', "{{ __('View Detail') }}"),
        ('Lainnya', "{{ __('Other') }}")
    ],
    'resources/views/livewire/pages/home.blade.php': [
        ('Sistem Informasi Layanan', "{{ __('Service Information System') }}"),
        ('Jelajahi & Lestarikan', "{{ __('Explore & Preserve') }}"),
        ('Warisan Budaya Kita', "{{ __('Our Cultural Heritage') }}"),
        ('Temukan informasi lengkap situs cagar budaya di D.I. Yogyakarta dan ajukan permohonan penggunaan fasilitas cagar budaya secara online.', "{{ __('Find complete information on cultural heritage sites in D.I. Yogyakarta and apply for the use of cultural heritage facilities online.') }}"),
        ('Jelajahi Katalog', "{{ __('Explore Catalog') }}"),
        ('Ajukan Fasilitas', "{{ __('Apply for Facility') }}"),
        ('Situs Terdaftar', "{{ __('Registered Sites') }}"),
        ('Situs Aktif Dikunjungi', "{{ __('Actively Visited Sites') }}"),
        ('Kategori Cagar Budaya', "{{ __('Cultural Heritage Categories') }}"),
        ('Situs Budaya Pilihan', "{{ __('Selected Cultural Sites') }}"),
        ('Beberapa rekomendasi cagar budaya yang dapat Anda kunjungi.', "{{ __('Some recommended cultural heritage sites that you can visit.') }}"),
        ('Lihat semua situs', "{{ __('View All Sites') }}"),
        ('Lihat semua\n', "{{ __('View All') }}\n"),
        ('Peta Lokasi Cagar Budaya', "{{ __('Cultural Heritage Location Map') }}"),
        ('Temukan lokasi cagar budaya yang tersebar di wilayah D.I. Yogyakarta dengan mudah melalui peta interaktif kami.', "{{ __('Find the locations of cultural heritage scattered across the D.I. Yogyakarta region easily through our interactive map.') }}"),
        ('Jelajahi Peta Penuh', "{{ __('Explore Full Map') }}"),
        ("{{ $site->category?->name ?? 'Lainnya' }}", "{{ $site->category?->name ?? __('Other') }}"),
    ],
    'resources/views/livewire/pages/heritage-site-index.blade.php': [
        ('Katalog Situs Cagar Budaya', "{{ __('Cultural Heritage Site Catalog') }}"),
        ('Jelajahi berbagai cagar budaya yang tersebar di wilayah D.I. Yogyakarta.', "{{ __('Explore various cultural heritage scattered across the D.I. Yogyakarta region.') }}"),
        ('Cari nama atau lokasi...', "{{ __('Search name or location...') }}"),
        ('Semua Kategori', "{{ __('All Categories') }}"),
        ('Semua Status', "{{ __('All Statuses') }}"),
        ('Aktif Dikunjungi', "{{ __('Actively Visited') }}"),
        ('Dalam Renovasi', "{{ __('Under Renovation') }}"),
        ('Tutup Sementara', "{{ __('Temporarily Closed') }}"),
        ('Grid', "{{ __('Grid') }}"),
        ('Peta\n', "{{ __('Map') }}\n"),
        ('Memuat data...', "{{ __('Loading data...') }}"),
        ("{{ $site->category?->name ?? 'Lainnya' }}", "{{ $site->category?->name ?? __('Other') }}"),
        ("'active' => 'Aktif'", "'active' => __('Active')"),
        ("'under_renovation' => 'Renovasi'", "'under_renovation' => __('Renovation')"),
        ("'temporarily_closed' => 'Tutup'", "'temporarily_closed' => __('Closed')"),
        ('Tidak ada situs ditemukan', "{{ __('No sites found') }}"),
        ('Coba sesuaikan kata kunci atau filter pencarian Anda.', "{{ __('Try adjusting your search keywords or filters.') }}"),
        ('Reset Filter', "{{ __('Reset Filter') }}"),
        ('Ditemukan {{ $allSites->count() }} lokasi cagar budaya berdasarkan filter saat ini.', "{{ __('Found :count cultural heritage locations based on the current filters.', ['count' => $allSites->count()]) }}")
    ],
    'resources/views/livewire/pages/heritage-site-detail.blade.php': [
        ('Katalog Situs', "{{ __('Site Catalog') }}"),
        ("{{ $site->category?->name ?? 'Kategori Lainnya' }}", "{{ $site->category?->name ?? __('Other Category') }}"),
        ("'active' => 'Aktif Dikunjungi'", "'active' => __('Actively Visited')"),
        ("'under_renovation' => 'Dalam Renovasi'", "'under_renovation' => __('Under Renovation')"),
        ("'temporarily_closed' => 'Tutup Sementara'", "'temporarily_closed' => __('Temporarily Closed')"),
        ('Belum ada foto tersedia', "{{ __('No photos available yet') }}"),
        ('Deskripsi', "{{ __('Description') }}"),
        ('Lokasi Peta', "{{ __('Map Location') }}"),
        ('Informasi Situs', "{{ __('Site Information') }}"),
        ('Nomor Registrasi Nasional', "{{ __('National Registration Number') }}"),
        ('Tahun Penetapan', "{{ __('Designation Year') }}"),
        ('Jam Operasional', "{{ __('Operating Hours') }}"),
        ('<span class="text-red-600 font-medium">Tutup</span>', '<span class="text-red-600 font-medium">{{ __(\'Closed\') }}</span>'),
        ('Gunakan Fasilitas Situs Ini', "{{ __('Use This Site\\'s Facilities') }}"),
        ('Anda dapat mengajukan permohonan untuk kegiatan budaya, penelitian, atau dokumentasi.', "{{ __('You can submit an application for cultural activities, research, or documentation.') }}"),
        ('Ajukan Permohonan', "{{ __('Submit Application') }}"),
        ('Fasilitas tidak dapat digunakan saat ini karena status situs:', "{{ __('Facilities cannot be used at this time due to site status:') }}"),
        ('Rekomendasi Lainnya', "{{ __('Other Recommendations') }}"),
        ("{{ $relatedSite->category?->name ?? 'Lainnya' }}", "{{ $relatedSite->category?->name ?? __('Other') }}"),
        ('Beranda\n', "{{ __('Home') }}\n")
    ],
    'resources/views/components/layouts/app.blade.php': [
        ("{{ __('Beranda') }}", "{{ __('Home') }}"),
        ("{{ __('Katalog Situs') }}", "{{ __('Cultural Heritage Site Catalog') }}"),
        ('Panel Pemohon', "{{ __('Applicant Panel') }}"),
        ('Login Pemohon', "{{ __('Applicant Login') }}"),
        ('Admin', "{{ __('Admin') }}"),
        ('Tautan Cepat', "{{ __('Quick Links') }}"),
        ('Katalog Situs Cagar Budaya', "{{ __('Cultural Heritage Site Catalog') }}"),
        ('Beranda', "{{ __('Home') }}"),
        ('Penggunaan Fasilitas', "{{ __('Facility Usage') }}"),
        ('Kontak', "{{ __('Contact') }}"),
        ('Sistem Informasi Layanan BPK Wilayah DIY', "{{ __('Service Information System of BPK Region DIY') }}"),
        ('Balai Pelestarian Kebudayaan Wilayah X<br>\n                        Daerah Istimewa Yogyakarta dan Jawa Tengah', "{!! __('Cultural Preservation Center Region X<br>Special Region of Yogyakarta and Central Java') !!}"),
        ('&copy; {{ date(\'Y\') }} Balai Pelestarian Kebudayaan Wilayah X. Hak Cipta Dilindungi.', "&copy; {{ date('Y') }} {{ __('Cultural Preservation Center Region X. All Rights Reserved.') }}")
    ]
}

translations = {
    'View Detail': 'Lihat Detail',
    'Service Information System': 'Sistem Informasi Layanan',
    'Explore & Preserve': 'Jelajahi & Lestarikan',
    'Our Cultural Heritage': 'Warisan Budaya Kita',
    'Find complete information on cultural heritage sites in D.I. Yogyakarta and apply for the use of cultural heritage facilities online.': 'Temukan informasi lengkap situs cagar budaya di D.I. Yogyakarta dan ajukan permohonan penggunaan fasilitas cagar budaya secara online.',
    'Explore Catalog': 'Jelajahi Katalog',
    'Apply for Facility': 'Ajukan Fasilitas',
    'Registered Sites': 'Situs Terdaftar',
    'Actively Visited Sites': 'Situs Aktif Dikunjungi',
    'Cultural Heritage Categories': 'Kategori Cagar Budaya',
    'Selected Cultural Sites': 'Situs Budaya Pilihan',
    'Some recommended cultural heritage sites that you can visit.': 'Beberapa rekomendasi cagar budaya yang dapat Anda kunjungi.',
    'View All Sites': 'Lihat semua situs',
    'View All': 'Lihat semua',
    'Cultural Heritage Location Map': 'Peta Lokasi Cagar Budaya',
    'Find the locations of cultural heritage scattered across the D.I. Yogyakarta region easily through our interactive map.': 'Temukan lokasi cagar budaya yang tersebar di wilayah D.I. Yogyakarta dengan mudah melalui peta interaktif kami.',
    'Explore Full Map': 'Jelajahi Peta Penuh',
    'Other': 'Lainnya',
    'Cultural Heritage Site Catalog': 'Katalog Situs Cagar Budaya',
    'Explore various cultural heritage scattered across the D.I. Yogyakarta region.': 'Jelajahi berbagai cagar budaya yang tersebar di wilayah D.I. Yogyakarta.',
    'Search name or location...': 'Cari nama atau lokasi...',
    'All Categories': 'Semua Kategori',
    'All Statuses': 'Semua Status',
    'Actively Visited': 'Aktif Dikunjungi',
    'Under Renovation': 'Dalam Renovasi',
    'Temporarily Closed': 'Tutup Sementara',
    'Grid': 'Grid',
    'Map': 'Peta',
    'Loading data...': 'Memuat data...',
    'Active': 'Aktif',
    'Renovation': 'Renovasi',
    'Closed': 'Tutup',
    'No sites found': 'Tidak ada situs ditemukan',
    'Try adjusting your search keywords or filters.': 'Coba sesuaikan kata kunci atau filter pencarian Anda.',
    'Reset Filter': 'Reset Filter',
    'Found :count cultural heritage locations based on the current filters.': 'Ditemukan :count lokasi cagar budaya berdasarkan filter saat ini.',
    'Site Catalog': 'Katalog Situs',
    'Other Category': 'Kategori Lainnya',
    'No photos available yet': 'Belum ada foto tersedia',
    'Description': 'Deskripsi',
    'Map Location': 'Lokasi Peta',
    'Site Information': 'Informasi Situs',
    'National Registration Number': 'Nomor Registrasi Nasional',
    'Designation Year': 'Tahun Penetapan',
    'Operating Hours': 'Jam Operasional',
    'Use This Site\'s Facilities': 'Gunakan Fasilitas Situs Ini',
    'You can submit an application for cultural activities, research, or documentation.': 'Anda dapat mengajukan permohonan untuk kegiatan budaya, penelitian, atau dokumentasi.',
    'Submit Application': 'Ajukan Permohonan',
    'Facilities cannot be used at this time due to site status:': 'Fasilitas tidak dapat digunakan saat ini karena status situs:',
    'Other Recommendations': 'Rekomendasi Lainnya',
    'Home': 'Beranda',
    'Applicant Panel': 'Panel Pemohon',
    'Applicant Login': 'Login Pemohon',
    'Admin': 'Admin',
    'Quick Links': 'Tautan Cepat',
    'Facility Usage': 'Penggunaan Fasilitas',
    'Contact': 'Kontak',
    'Service Information System of BPK Region DIY': 'Sistem Informasi Layanan BPK Wilayah DIY',
    'Cultural Preservation Center Region X<br>Special Region of Yogyakarta and Central Java': 'Balai Pelestarian Kebudayaan Wilayah X<br>\n                        Daerah Istimewa Yogyakarta dan Jawa Tengah',
    'Cultural Preservation Center Region X. All Rights Reserved.': 'Balai Pelestarian Kebudayaan Wilayah X. Hak Cipta Dilindungi.',
}

# Update views
for filepath, pairs in replacements.items():
    with open(filepath, 'r') as f:
        content = f.read()
    
    for search, replace in pairs:
        content = content.replace(search, replace)
        
    with open(filepath, 'w') as f:
        f.write(content)

# Update lang/id.json
lang_file = 'lang/id.json'
if os.path.exists(lang_file):
    with open(lang_file, 'r') as f:
        try:
            current_lang = json.load(f)
        except:
            current_lang = {}
else:
    current_lang = {}

current_lang.update(translations)

with open(lang_file, 'w') as f:
    json.dump(current_lang, f, indent=4)

print("Done updating views and lang/id.json")
