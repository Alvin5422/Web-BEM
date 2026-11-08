<?php

namespace Database\Seeders;

use App\Models\Aspiration;
use App\Models\Category;
use App\Models\Event;
use App\Models\Media;
use App\Models\Member;
use App\Models\Message;
use App\Models\Period;
use App\Models\Post;
use App\Models\Program;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        $superAdmin = User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@stikstamalanrea.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
            'is_active' => true,
            'phone' => '082199887766',
        ]);

        $admin = User::create([
            'name' => 'Admin Humas & Informasi',
            'email' => 'admin@stikstamalanrea.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => true,
            'phone' => '082199887755',
        ]);

        // 2. Site Settings
        $settings = [
            'site_name' => 'BEM STIKS Tamalanrea Makassar',
            'campus_name' => 'Sekolah Tinggi Ilmu Kesejahteraan Sosial Tamalanrea Makassar',
            'campus_short' => 'STIKS Tamalanrea Makassar',
            'tagline' => 'Ruang Berkarya, Bergerak, dan Mengabdi',
            'cabinet_name' => 'Kabinet Ananta Anardhaya',
            'active_period' => '2026/2027',
            'logo_bem' => 'images/logo/logo-bem.png',
            'logo_campus' => 'images/logo/logo-stiks.jpg',
            'email' => 'bem@stikstamalanrea.ac.id',
            'phone' => '+62 821-9988-7766',
            'whatsapp' => '6282199887766',
            'instagram' => 'https://instagram.com/bemstikstamalanrea',
            'youtube' => 'https://youtube.com/@bemstikstamalanrea',
            'tiktok' => 'https://tiktok.com/@bemstikstamalanrea',
            'address' => 'Jl. Perintis Kemerdekaan KM. 11, Tamalanrea Indah, Kec. Tamalanrea, Kota Makassar, Sulawesi Selatan 90245',
            'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.8396265737525!2d119.4939766!3d-5.1293798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefd40c6b4aa3d%3A0xc36dbefcb2fa123!2sTamalanrea%2C%20Makassar!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid',
            'sambutan_ketua_nama' => 'Ahmad Fauzan Pratama',
            'sambutan_ketua_periode' => 'Ketua BEM STIKS Tamalanrea Periode 2026/2027',
            'sambutan_ketua_foto' => 'images/team/ketua-bem.jpg',
            'sambutan_ketua_text' => 'Selamat datang di portal resmi Badan Eksekutif Mahasiswa STIKS Tamalanrea Makassar. Sebagai wadah aspirasi, kolaborasi, dan aktualisasi mahasiswa kesejahteraan sosial, kami berkomitmen untuk terus menghadirkan karya nyata yang berpihak pada nilai-nilai kemanusiaan dan kemaslahatan masyarakat kampus serta masyarakat luas. Mari bersama bersinergi, bergerak, dan mengabdi untuk masa depan yang lebih berkeadilan sosial.',
            'visi' => 'Terwujudnya BEM STIKS Tamalanrea Makassar yang berintegritas, responsif, solutif, dan inklusif dalam mengawal kemajuan civitas akademika serta berdedikasi nyata bagi kesejahteraan sosial masyarakat.',
            'misi' => "1. Mengoptimalkan peran advokasi dan pelayanan yang responsif terhadap seluruh kebutuhan mahasiswa.\n2. Mengembangkan potensi kepemimpinan, intelektual, dan bakat minat mahasiswa berbasis nilai-nilai kemanusiaan.\n3. Membangun tata kelola organisasi yang transparan, akuntabel, dan profesional melalui digitalisasi informasi.\n4. Memperluas jejaring kolaborasi antarmahasiswa, alumni, instansi kesejahteraan sosial, dan masyarakat luas.\n5. Menginisiasi program pengabdian masyarakat yang berkelanjutan dan berdampak langsung pada problem sosial kemasyarakatan.",
            'sejarah' => 'Badan Eksekutif Mahasiswa Sekolah Tinggi Ilmu Kesejahteraan Sosial (STIKS) Tamalanrea Makassar didirikan sebagai wadah kedaulatan mahasiswa dalam mengaktualisasikan Tri Dharma Perguruan Tinggi, khususnya di bidang pendidikan, penelitian, dan pengabdian masyarakat yang berfokus pada pembangunan kesejahteraan sosial di kawasan Indonesia Timur. Sejak awal berdirinya, BEM STIKS Tamalanrea terus bertransformasi menjadi garda terdepan dalam pembinaan kepemimpinan mahasiswa dan pengawalan isu-isu kemanusiaan.',
            'filosofi_logo' => "Lambang BEM STIKS Tamalanrea Makassar merepresentasikan perpaduan nilai akademik, kearifan lokal Sulawesi Selatan, dan komitmen kemanusiaan:\n\n1. Perisai Etnik: Terinspirasi dari ukiran khas Sulawesi Selatan (Pa'teddong & Passura) melambangkan ketahanan moral, kepribadian yang luhur, dan komitmen menjaga amanah mahasiswa.\n2. Padi dan Daun Melati/Laurel: Melambangkan kemakmuran, kematangan berpikir, dan cita-cita luhur dalam menghadirkan kesejahteraan sosial bagi masyarakat.\n3. Buku Terbuka dan Pena Bulu: Simbol fondasi keilmuan sosial, literasi kritis, dan ketajaman gagasan mahasiswa dalam merespons realitas sosial kemasyarakatan.\n4. Mahkota Tiga Lekuk: Melambangkan Tri Dharma Perguruan Tinggi (Pendidikan, Penelitian, dan Pengabdian kepada Masyarakat) sebagai ruh perjuangan BEM.\n5. Harmoni Warna Hijau & Emas: Hijau (#123F29) melambangkan pertumbuhan, empati sosial, dan kedamaian; Emas (#D5AE2B) melambangkan kejayaan, kemuliaan budi pekerti, dan dedikasi pengabdian tertinggi.",
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::create(['key' => $key, 'value' => $val, 'group' => 'general']);
        }

        // 3. Periods
        $periodActive = Period::create([
            'name' => '2026/2027',
            'cabinet_name' => 'Kabinet Ananta Anardhaya',
            'leader_name' => 'Ahmad Fauzan Pratama',
            'vice_leader_name' => 'Nurul Aulia Rahmah',
            'motto' => 'Abadi dalam Kebaikan, Nyata dalam Pengabdian',
            'vision' => 'Terwujudnya BEM STIKS Tamalanrea yang responsif, adaptif, dan berjiwa sosial tinggi dalam mewujudkan kemaslahatan mahasiswa dan masyarakat.',
            'mission' => "1. Menjadi jembatan advokasi mahasiswa yang transparan dan berintegritas.\n2. Memperkuat kapasitas keilmuan dan praktik pekerja sosial.\n3. Menggiatkan aksi sosial kemasyarakatan yang tepat sasaran.",
            'is_active' => true,
            'start_year' => 2026,
            'end_year' => 2027,
        ]);

        $periodPast1 = Period::create([
            'name' => '2025/2026',
            'cabinet_name' => 'Kabinet Sinergi Perubahan',
            'leader_name' => 'Muhammad Rizky Pratama',
            'vice_leader_name' => 'Siti Nurhaliza',
            'motto' => 'Bersinergi untuk Negeri, Berdaya Bersama Mahasiswa',
            'is_active' => false,
            'start_year' => 2025,
            'end_year' => 2026,
        ]);

        $periodPast2 = Period::create([
            'name' => '2024/2025',
            'cabinet_name' => 'Kabinet Harmoni Aksi',
            'leader_name' => 'Andi Muh. Fadil',
            'vice_leader_name' => 'Fitriani Amalia',
            'motto' => 'Harmoni Langkah, Dedikasi Tanpa Batas',
            'is_active' => false,
            'start_year' => 2024,
            'end_year' => 2025,
        ]);

        // 4. Members (Kabinet Aktif)
        $membersData = [
            // BPH Inti
            [
                'name' => 'Ahmad Fauzan Pratama',
                'nim' => '23.01.042',
                'role_title' => 'Ketua BEM',
                'department' => 'BPH Inti',
                'bio' => 'Mahasiswa Program Studi Ilmu Kesejahteraan Sosial angkatan 2023. Memiliki fokus pada advokasi sosial dan manajemen organisasi kemahasiswaan.',
                'order' => 1,
            ],
            [
                'name' => 'Nurul Aulia Rahmah',
                'nim' => '23.01.077',
                'role_title' => 'Wakil Ketua BEM',
                'department' => 'BPH Inti',
                'bio' => 'Aktif dalam kegiatan pemberdayaan komunitas anak dan remaja, berpengalaman dalam koordinasi lintas bidang kemahasiswaan.',
                'order' => 2,
            ],
            [
                'name' => 'Siti Rahmawati',
                'nim' => '23.01.018',
                'role_title' => 'Sekretaris Umum',
                'department' => 'BPH Inti',
                'bio' => 'Bertanggung jawab atas administrasi kelembagaan, persuratan resmi, dan dokumentasi rapat koordinasi BEM.',
                'order' => 3,
            ],
            [
                'name' => 'Muh. Ilham Saputra',
                'nim' => '24.01.031',
                'role_title' => 'Wakil Sekretaris Umum',
                'department' => 'BPH Inti',
                'bio' => 'Mendukung pengelolaan kearsipan digital dan inventarisasi dokumen keorganisasian.',
                'order' => 4,
            ],
            [
                'name' => 'Dinda Ayu Lestari',
                'nim' => '23.01.055',
                'role_title' => 'Bendahara Umum',
                'department' => 'BPH Inti',
                'bio' => 'Mengelola transparansi anggaran kas organisasi, pembukuan keuangan program, dan pertanggungjawaban dana kemahasiswaan.',
                'order' => 5,
            ],

            // Departemen Advokasi & Kesejahteraan Mahasiswa
            [
                'name' => 'Fajar Hidayat',
                'nim' => '23.01.089',
                'role_title' => 'Kepala Bidang Advokasi & Kesma',
                'department' => 'Advokasi & Kesejahteraan Mahasiswa',
                'bio' => 'Fokus pada penyaluran aspirasi mahasiswa, pendampingan akademik, dan advokasi fasilitas perkuliahan.',
                'order' => 6,
            ],
            [
                'name' => 'Putri Maharani',
                'nim' => '24.01.012',
                'role_title' => 'Staf Ahli Advokasi',
                'department' => 'Advokasi & Kesejahteraan Mahasiswa',
                'bio' => 'Membantu pengelolaan kanal aduan mahasiswa dan survei kepuasan fasilitas kampus.',
                'order' => 7,
            ],

            // Departemen Pengabdian Masyarakat & Aksi Sosial
            [
                'name' => 'Rian Alamsyah',
                'nim' => '23.01.064',
                'role_title' => 'Kepala Bidang Pengabdian Masyarakat',
                'department' => 'Pengabdian Masyarakat & Aksi Sosial',
                'bio' => 'Menginisiasi program bina desa sosial, tanggap bencana, dan pendampingan kelompok rentan di Makassar.',
                'order' => 8,
            ],
            [
                'name' => 'Nabila Syifa',
                'nim' => '24.01.048',
                'role_title' => 'Staf Bidang Pengabdian',
                'department' => 'Pengabdian Masyarakat & Aksi Sosial',
                'bio' => 'Koordinator relawan sosial kemasyarakatan dan kemitraan dengan yayasan sosial.',
                'order' => 9,
            ],

            // Departemen Pengembangan Karakter & Kaderisasi
            [
                'name' => 'Kevin Mahendra',
                'nim' => '23.01.023',
                'role_title' => 'Kepala Bidang Kaderisasi & PSDM',
                'department' => 'Pengembangan Karakter & Kaderisasi',
                'bio' => 'Merancang silabus LKMM dan pelatihan kepemimpinan berintegritas untuk mahasiswa baru.',
                'order' => 10,
            ],
            [
                'name' => 'Dian Safitri',
                'nim' => '24.01.060',
                'role_title' => 'Staf Kaderisasi',
                'department' => 'Pengembangan Karakter & Kaderisasi',
                'bio' => 'Fasilitator orientasi mahasiswa baru dan pengembangan soft skills keorganisasian.',
                'order' => 11,
            ],

            // Departemen Komunikasi, Informasi & Hubungan Publik
            [
                'name' => 'Alif Ramadhan',
                'nim' => '23.01.034',
                'role_title' => 'Kepala Bidang Komunikasi & Informasi',
                'department' => 'Komunikasi & Informasi',
                'bio' => 'Mengawasi publikasi media sosial, pengelolaan portal web BEM, dan hubungan eksternal.',
                'order' => 12,
            ],
            [
                'name' => 'Amanda Febrianti',
                'nim' => '24.01.028',
                'role_title' => 'Staf Kreatif & Media',
                'department' => 'Komunikasi & Informasi',
                'bio' => 'Editor konten visual, dokumentasi fotografi, dan buletin berkala kemahasiswaan.',
                'order' => 13,
            ],

            // Departemen Minat, Bakat & Penalaran Ilmiah
            [
                'name' => 'Bayu Aditya',
                'nim' => '23.01.092',
                'role_title' => 'Kepala Bidang Minat, Bakat & Penalaran',
                'department' => 'Minat Bakat & Penalaran',
                'bio' => 'Mendorong prestasi mahasiswa dalam karya tulis ilmiah sosial, debat, dan keolahragaan.',
                'order' => 14,
            ],
            [
                'name' => 'Zahra Amelia',
                'nim' => '24.01.071',
                'role_title' => 'Staf Penalaran Ilmiah',
                'department' => 'Minat Bakat & Penalaran',
                'bio' => 'Koordinator kelompok belajar riset sosial dan bimbingan lomba karya ilmiah nasional.',
                'order' => 15,
            ],
        ];

        foreach ($membersData as $m) {
            Member::create(array_merge($m, [
                'period_id' => $periodActive->id,
                'photo' => null,
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
            ]));
        }

        // 5. Categories
        $categories = [
            [
                'name' => 'Berita BEM',
                'slug' => 'berita-bem',
                'description' => 'Informasi resmi kegiatan, kebijakan, dan perkembangan organisasi BEM STIKS.',
                'color' => '#123F29',
            ],
            [
                'name' => 'Kegiatan Sosial',
                'slug' => 'kegiatan-sosial',
                'description' => 'Dokumentasi bakti sosial, aksi kepedulian masyarakat, dan pengabdian komunitas.',
                'color' => '#2E7D32',
            ],
            [
                'name' => 'Akademik & Kemahasiswaan',
                'slug' => 'akademik-kemahasiswaan',
                'description' => 'Informasi perkuliahan, seminar ilmiah, workshop, dan prestasi mahasiswa.',
                'color' => '#1565C0',
            ],
            [
                'name' => 'Pengumuman',
                'slug' => 'pengumuman',
                'description' => 'Pemberitahuan resmi jadwal, pendaftaran, dan edaran penting kemahasiswaan.',
                'color' => '#D5AE2B',
            ],
            [
                'name' => 'Artikel & Edukasi',
                'slug' => 'artikel-edukasi',
                'description' => 'Tulisan ilmiah populer, opini mahasiswa, dan wawasan seputar ilmu kesejahteraan sosial.',
                'color' => '#6A1B9A',
            ],
        ];

        $catModels = [];
        foreach ($categories as $cat) {
            $catModels[$cat['slug']] = Category::create($cat);
        }

        // 6. Posts
        $postsData = [
            [
                'title' => 'BEM STIKS Tamalanrea Gelar Pengabdian Bina Desa Sosial di Wilayah Pesisir',
                'slug' => 'bem-stiks-tamalanrea-gelar-pengabdian-bina-desa-sosial',
                'category_id' => $catModels['kegiatan-sosial']->id,
                'user_id' => $admin->id,
                'excerpt' => 'Sebagai wujud nyata implementasi ilmu kesejahteraan sosial, BEM STIKS Tamalanrea melaksanakan pendampingan sosial dan edukasi sanitasi bagi masyarakat pesisir.',
                'content' => "<p><strong>MAKASSAR</strong> — Badan Eksekutif Mahasiswa Sekolah Tinggi Ilmu Kesejahteraan Sosial (STIKS) Tamalanrea Makassar sukses menyelenggarakan program pengabdian masyarakat bertajuk <em>Bina Desa Sosial 2026</em>. Kegiatan yang berlangsung selama tiga hari ini berfokus pada pendampingan keluarga pra-sejahtera dan penguatan ketahanan sosial masyarakat pesisir.</p>

<p>Ketua BEM STIKS Tamalanrea Makassar, Ahmad Fauzan Pratama, menyampaikan bahwa keterlibatan mahasiswa secara langsung di tengah masyarakat merupakan inti dari panggilan profesi pekerja sosial. 'Kami tidak hanya hadir membawa bantuan logistik, tetapi yang terpenting adalah melakukan asesmen sosial, mendengarkan persoalan warga, serta memfasilitasi solusi berbasis potensi lokal,' ungkap Fauzan.</p>

<p>Rangkaian kegiatan mencakup penyuluhan pola hidup bersih dan sehat, pendampingan belajar bagi anak-anak usia sekolah dasar, serta pelatihan kewirausahaan mikro bagi kelompok ibu rumah tangga. Warga setempat menyambut antusias program ini dan berharap kerja sama berkelanjutan dapat terus terjalin bersama kampus STIKS Tamalanrea.</p>",
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'views_count' => 342,
            ],
            [
                'title' => 'Dialog Publik: Penguatan Peran Pekerja Sosial dalam Mitigasi Kemiskinan Terpadu',
                'slug' => 'dialog-publik-penguatan-peran-pekerja-sosial-mitigasi-kemiskinan',
                'category_id' => $catModels['akademik-kemahasiswaan']->id,
                'user_id' => $superAdmin->id,
                'excerpt' => 'Menghadirkan narasumber dari Dinas Sosial dan praktisi kesejahteraan sosial, BEM STIKS mengkaji strategi integrasi bantuan sosial berbasis pemberdayaan mandiri.',
                'content' => "<p><strong>MAKASSAR</strong> — Bertempat di Aula STIKS Tamalanrea, BEM menyelenggarakan dialog publik bertema <em>'Arah Kebijakan Kesejahteraan Sosial Indonesia Timur di Era Transformasi Digital'</em>. Forum ilmiah ini dihadiri oleh puluhan mahasiswa, dosen, serta perwakilan lembaga kesejahteraan sosial mitra.</p>

<p>Dalam forum tersebut ditegaskan pentingnya akurasi data kemiskinan dan intervensi berbasis komunitas. Mahasiswa STIKS Tamalanrea diharapkan menjadi katalisator perubahan yang mampu mengawasi program jaminan sosial agar benar-benar menyentuh masyarakat yang membutuhkan.</p>

<p>Acara ditutup dengan perumusan rekomendasi kebijakan kemahasiswaan yang akan diserahkan kepada pemangku kebijakan terkait sebagai bentuk sumbangsih pemikiran kritis mahasiswa sosial.</p>",
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'views_count' => 285,
            ],
            [
                'title' => 'Pengumuman Pendaftaran Latihan Keterampilan Manajemen Mahasiswa (LKMM-TD) 2026',
                'slug' => 'pengumuman-pendaftaran-lkmm-td-2026',
                'category_id' => $catModels['pengumuman']->id,
                'user_id' => $admin->id,
                'excerpt' => 'BEM STIKS Tamalanrea membuka pendaftaran LKMM Tingkat Dasar untuk seluruh mahasiswa semester awal yang ingin memperdalam kemampuan kepemimpinan dan manajerial.',
                'content' => "<p>Diberitahukan kepada seluruh mahasiswa aktif STIKS Tamalanrea Makassar, Bidang Kaderisasi & PSDM BEM membuka pendaftaran peserta <strong>Latihan Keterampilan Manajemen Mahasiswa Tingkat Dasar (LKMM-TD) 2026</strong>.</p>

<p><strong>Ketentuan Pendaftaran:</strong></p>
<ul>
<li>Mahasiswa aktif semester 1 atau 3 STIKS Tamalanrea Makassar.</li>
<li>Mengisi formulir pendaftaran daring melalui sekretariat BEM.</li>
<li>Menyertakan esai singkat bertema 'Peranku untuk Kesejahteraan Kampus'.</li>
<li>Batas akhir pendaftaran: 25 November 2026.</li>
</ul>

<p>Pelatihan ini akan membekali peserta dengan keterampilan problem solving, manajemen konflik organisasi, teknik persidangan, serta etika kepemimpinan yang humanis.</p>",
                'status' => 'published',
                'published_at' => now()->subDays(8),
                'views_count' => 512,
            ],
            [
                'title' => 'Rapat Kerja BEM Kabinet Ananta Anardhaya: Penetapan 18 Program Kerja Unggulan',
                'slug' => 'rapat-kerja-bem-kabinet-ananta-anardhaya',
                'category_id' => $catModels['berita-bem']->id,
                'user_id' => $admin->id,
                'excerpt' => 'Seluruh pengurus bidang BEM STIKS Tamalanrea telah menetapkan matrikulasi program kerja strategis untuk periode kepengurusan 2026/2027.',
                'content' => '<p>Rapat Kerja Badan Eksekutif Mahasiswa (BEM) STIKS Tamalanrea Makassar resmi ditutup dengan penetapan 18 program kerja terpadu. Fokus utama tahun ini dititikberatkan pada digitalisasi layanan aspirasi mahasiswa, advokasi beasiswa, serta penguatan pengabdian masyarakat berkelanjutan.</p>

<p>Seluruh program kerja dirancang terukur dan memiliki linimasa yang jelas, sehingga mahasiswa dapat memantau capaian kinerja BEM secara terbuka melalui portal web resmi ini.</p>',
                'status' => 'published',
                'published_at' => now()->subDays(14),
                'views_count' => 198,
            ],
            [
                'title' => 'Opini: Mengapa Perspektif Hak Asasi Manusia Wajib Menjadi Landasan Pekerja Sosial',
                'slug' => 'opini-perspektif-ham-landasan-pekerja-sosial',
                'category_id' => $catModels['artikel-edukasi']->id,
                'user_id' => $superAdmin->id,
                'excerpt' => 'Tulisan reflektif mahasiswa mengenai pentingnya memandang penerima manfaat bukan sebagai objek belas kasihan, melainkan subjek yang berdaulat atas hak-hak dasarnya.',
                'content' => '<p>Kesejahteraan sosial bukan sekadar pemberian amal atau bantuan karitatif. Paradigma modern memposisikan pekerjaan sosial sebagai profesi berbasis hak asasi manusia (human rights-based approach). Ketika kita mendampingi anak jalanan, lansia terlantar, atau korban kekerasan, kita hadir untuk memulihkan martabat kemanusiaan mereka.</p>

<p>Melalui tulisan ini, mahasiswa diajak untuk terus mengasah kepekaan etis, memahami kode etik pekerja sosial, dan konsisten menyuarakan keadilan bagi kelompok marginal.</p>',
                'status' => 'published',
                'published_at' => now()->subDays(20),
                'views_count' => 430,
            ],
        ];

        foreach ($postsData as $p) {
            Post::create($p);
        }

        // 7. Programs (Program Kerja)
        $programs = [
            [
                'period_id' => $periodActive->id,
                'department' => 'Pengabdian Masyarakat & Aksi Sosial',
                'name' => 'Bina Desa Sosial & Pendampingan Komunitas Rentan',
                'description' => 'Program pengabdian masyarakat terintegrasi yang melibatkan mahasiswa pekerja sosial dalam mendampingi keluarga pra-sejahtera, edukasi kesehatan sosial, dan pemberdayaan anak.',
                'objective' => 'Meningkatkan ketahanan sosial komunitas dan melatih kompetensi praktikum lapangan mahasiswa.',
                'target_audience' => 'Masyarakat pesisir dan komunitas pra-sejahtera di Makassar',
                'status' => 'berjalan',
                'start_date' => '2026-10-01',
                'end_date' => '2027-02-28',
                'person_in_charge' => 'Rian Alamsyah (Kabid Pengabdian)',
                'is_featured' => true,
            ],
            [
                'period_id' => $periodActive->id,
                'department' => 'Advokasi & Kesejahteraan Mahasiswa',
                'name' => 'Ruang Aspirasi & Posko Bantuan Mahasiswa',
                'description' => 'Fasilitasi penyaluran aspirasi mahasiswa terkait sarana perkuliahan, bimbingan akademik, serta advokasi keringanan pembayaran SPP bagi mahasiswa kurang mampu.',
                'objective' => 'Menjamin terwujudnya lingkungan kampus yang adil, suportif, dan bebas hambatan administrasi sepihak.',
                'target_audience' => 'Seluruh Mahasiswa Aktif STIKS Tamalanrea',
                'status' => 'berjalan',
                'start_date' => '2026-09-01',
                'end_date' => '2027-08-31',
                'person_in_charge' => 'Fajar Hidayat (Kabid Advokasi)',
                'is_featured' => true,
            ],
            [
                'period_id' => $periodActive->id,
                'department' => 'Pengembangan Karakter & Kaderisasi',
                'name' => 'Latihan Keterampilan Manajemen Mahasiswa (LKMM-TD)',
                'description' => 'Kaderisasi kepemimpinan formal bertahap untuk mencetak organisatoris muda yang memiliki integritas moral, kemampuan komunikasi, dan etika profesi.',
                'objective' => 'Regenerasi kepemimpinan mahasiswa dan penanaman nilai-nilai kepedulian sosial.',
                'target_audience' => 'Mahasiswa Baru & Anggota BEM Muda',
                'status' => 'direncanakan',
                'start_date' => '2026-11-25',
                'end_date' => '2026-11-27',
                'person_in_charge' => 'Kevin Mahendra (Kabid Kaderisasi)',
                'is_featured' => true,
            ],
            [
                'period_id' => $periodActive->id,
                'department' => 'Minat Bakat & Penalaran',
                'name' => 'Pekan Ilmiah & Bedah Riset Sosial Mahasiswa',
                'description' => 'Forum diskusi ilmiah, pelatihan penulisan karya tulis ilmiah (KTI), serta kompetisi esai bertema isu-isu kesejahteraan sosial kontemporer.',
                'objective' => 'Menumbuhkan budaya literasi dan penelitian kritis di kalangan mahasiswa.',
                'target_audience' => 'Civitas akademika STIKS Tamalanrea',
                'status' => 'direncanakan',
                'start_date' => '2027-01-15',
                'end_date' => '2027-01-20',
                'person_in_charge' => 'Bayu Aditya (Kabid Minat Bakat)',
                'is_featured' => false,
            ],
            [
                'period_id' => $periodActive->id,
                'department' => 'Komunikasi & Informasi',
                'name' => 'Digitalisasi Informasi & Portal Web Resmi BEM',
                'description' => 'Pembangunan portal website resmi BEM STIKS Tamalanrea untuk transparansi kegiatan, publikasi kalender proker, serta sentralisasi layanan aspirasi mahasiswa.',
                'objective' => 'Mewujudkan keterbukaan informasi publik dan akuntabilitas kinerja BEM secara modern.',
                'target_audience' => 'Mahasiswa, Dosen, Alumni, dan Khalayak Umum',
                'status' => 'selesai',
                'start_date' => '2026-09-10',
                'end_date' => '2026-11-08',
                'person_in_charge' => 'Alif Ramadhan (Kabid Kominfo)',
                'is_featured' => false,
            ],
        ];

        $progModels = [];
        foreach ($programs as $pr) {
            $progModels[] = Program::create($pr);
        }

        // 8. Events (Agenda Kegiatan)
        $eventsData = [
            [
                'program_id' => $progModels[1]->id, // LKMM-TD
                'title' => 'Pelaksanaan Latihan Keterampilan Manajemen Mahasiswa (LKMM-TD)',
                'slug' => 'pelaksanaan-lkmm-td-2026',
                'description' => 'Pelatihan kepemimpinan dasar mahasiswa untuk membentuk kader yang memiliki visi kebangsaan dan dedikasi sosial kemasyarakatan.',
                'location' => 'Aula Utama STIKS Tamalanrea Makassar',
                'event_date' => now()->addDays(12)->toDateString(),
                'start_time' => '08:30',
                'end_time' => '16:00',
                'status' => 'mendatang',
            ],
            [
                'program_id' => $progModels[0]->id, // Bina Desa
                'title' => 'Aksi Bakti Sosial dan Penyerahan Bantuan Alat Edukasi Anak',
                'slug' => 'aksi-bakti-sosial-penyerahan-bantuan-edukasi',
                'description' => 'Kunjungan sosial penyerahan donasi buku bacaan dan alat tulis untuk anak-anak binaan pesisir binaan BEM.',
                'location' => 'Pos Pemberdayaan Masyarakat, Tamalanrea',
                'event_date' => now()->addDays(20)->toDateString(),
                'start_time' => '09:00',
                'end_time' => '14:00',
                'status' => 'mendatang',
            ],
            [
                'program_id' => null,
                'title' => 'Seminar Kebangsaan: Peran Mahasiswa Menjawab Problem Sosial Makassar',
                'slug' => 'seminar-kebangsaan-problem-sosial-makassar',
                'description' => 'Diskusi panel interaktif bersama akademisi dan pekerja sosial senior membahas dinamika sosial perkotaan.',
                'location' => 'Ruang Seminar Lantai 2 Kampus',
                'event_date' => now()->addDays(28)->toDateString(),
                'start_time' => '13:00',
                'end_time' => '17:00',
                'status' => 'mendatang',
            ],
            [
                'program_id' => $progModels[4]->id, // Digitalisasi
                'title' => 'Pelantikan & Rapat Kerja Pengurus BEM Periode 2026/2027',
                'slug' => 'pelantikan-rapat-kerja-bem-2026-2027',
                'description' => 'Prosesi sumpah jabatan pengurus baru Kabinet Ananta Anardhaya dilanjutkan dengan perumusan program kerja tahunan.',
                'location' => 'Auditorium Kampus STIKS Tamalanrea',
                'event_date' => now()->subDays(25)->toDateString(),
                'start_time' => '08:00',
                'end_time' => '17:30',
                'status' => 'selesai',
            ],
        ];

        foreach ($eventsData as $ev) {
            Event::create($ev);
        }

        // 9. Media Gallery
        $mediaData = [
            [
                'title' => 'Rapat Pleno BEM dan Penetapan Program Kerja',
                'caption' => 'Suasana musyawarah kerja pengurus BEM membahas rencana strategis kemahasiswaan.',
                'category' => 'Rapat Kerja',
                'file_path' => 'images/gallery/gallery-1.jpg',
                'taken_at' => now()->subDays(25),
            ],
            [
                'title' => 'Aksi Sosial Mahasiswa Peduli Korban Banjir',
                'caption' => 'Penyaluran bantuan logistik dan pendampingan trauma healing anak.',
                'category' => 'Aksi Sosial',
                'file_path' => 'images/gallery/gallery-2.jpg',
                'taken_at' => now()->subDays(18),
            ],
            [
                'title' => 'Pelatihan Penulisan Asesmen Pekerja Sosial',
                'caption' => 'Workshop peningkatan kapasitas analisis kasus kemiskinan dan disabilitas.',
                'category' => 'Pelatihan',
                'file_path' => 'images/gallery/gallery-3.jpg',
                'taken_at' => now()->subDays(10),
            ],
            [
                'title' => 'Kunjungan Studi Lembaga Kesejahteraan Sosial',
                'caption' => 'Observasi tata kelola panti dan program perlindungan anak.',
                'category' => 'Studi Lapangan',
                'file_path' => 'images/gallery/gallery-4.jpg',
                'taken_at' => now()->subDays(5),
            ],
            [
                'title' => 'Pekan Olahraga Mahasiswa Antar Kelas',
                'caption' => 'Mempererat tali silaturahmi civitas akademika melalui kompetisi futsal dan bulu tangkis.',
                'category' => 'Kemahasiswaan',
                'file_path' => 'images/gallery/gallery-5.jpg',
                'taken_at' => now()->subDays(12),
            ],
            [
                'title' => 'Forum Diskusi Rutin: Pojok Literasi Sosial',
                'caption' => 'Diskusi kritis mingguan seputar perkembangan kebijakan jaminan sosial.',
                'category' => 'Diskusi Ilmiah',
                'file_path' => 'images/gallery/gallery-6.jpg',
                'taken_at' => now()->subDays(3),
            ],
        ];

        foreach ($mediaData as $med) {
            Media::create($med);
        }

        // 10. Aspirations
        Aspiration::create([
            'tracking_code' => 'ASP-20261108-001',
            'name' => 'Muhammad Rifky',
            'is_anonymous' => false,
            'nim' => '23.01.088',
            'study_program' => 'S1 Ilmu Kesejahteraan Sosial',
            'email' => 'rifky@student.stikstamalanrea.ac.id',
            'phone' => '081234567890',
            'topic' => 'Fasilitas Kampus',
            'subject' => 'Usulan Penambahan Stopkontak dan Penguatan Akses WiFi di Ruang Baca',
            'content' => 'Selamat siang pengurus BEM, mohon kiranya dapat mengadvokasikan penambahan titik colokan listrik serta perluasan jangkauan hotspot internet di ruang perpustakaan dan ruang baca lantai 2 agar mahasiswa lebih nyaman saat mengerjakan tugas kelompok.',
            'status' => 'diproses',
            'admin_notes' => 'Telah dikoordinasikan dengan Kabid Advokasi untuk dimasukkan ke surat usulan fasilitas sarana kampus.',
            'response' => 'Terima kasih atas aspirasi yang disampaikan. Surat permohonan penambahan fasilitas telah kami teruskan ke bagian Umum dan Sarana Kampus per tanggal 5 November 2026. Kami akan mengawal realisasinya.',
            'responded_at' => now()->subDay(),
        ]);

        Aspiration::create([
            'tracking_code' => 'ASP-20261108-002',
            'name' => 'Anonim',
            'is_anonymous' => true,
            'nim' => null,
            'study_program' => 'S1 Ilmu Kesejahteraan Sosial',
            'email' => null,
            'phone' => null,
            'topic' => 'Akademik & Kurikulum',
            'subject' => 'Permohonan Kejelasan Jadwal Ujian Tengah Semester',
            'content' => 'Mohon bantuan rekan-rekan BEM untuk meminta bagian akademik merilis jadwal fix UTS lebih awal agar mahasiswa perantau bisa mengatur agenda belajar.',
            'status' => 'selesai',
            'admin_notes' => 'Akademik telah merilis kalender resmi via website dan mading.',
            'response' => 'Jadwal resmi UTS telah dipublikasikan oleh Bagian Akademik per tanggal 6 November 2026 dan dapat diunduh pada papan pengumuman resmi.',
            'responded_at' => now()->subDays(2),
        ]);

        // 11. Messages
        Message::create([
            'name' => 'Indah Permatasari',
            'email' => 'indah.permatasari@gmail.com',
            'phone' => '082233445566',
            'subject' => 'Pertanyaan Kemitraan Kegiatan Bakti Sosial',
            'message' => 'Halo BEM STIKS Tamalanrea Makassar, kami dari Komunitas Relawan Makassar ingin mengajak kolaborasi dalam agenda penanaman mangrove dan edukasi anak pesisir bulan depan. Mohon informasi narahubung yang bisa kami hubungi lebih lanjut. Terima kasih.',
            'is_read' => true,
            'replied_at' => now()->subDay(),
            'admin_notes' => 'Sudah dibalas melalui WhatsApp oleh Kabid Pengmas.',
        ]);

        Message::create([
            'name' => 'Drs. H. Anwar, M.Si',
            'email' => 'anwar_sosial@yahoo.com',
            'phone' => '08119876543',
            'subject' => 'Undangan Forum Lembaga Kesejahteraan Sosial Sulsel',
            'message' => 'Dengan hormat, kami bermaksud mengundang perwakilan BEM STIKS Tamalanrea untuk hadir sebagai peninjau dalam Rapat Koordinasi Lembaga Kesejahteraan Sosial se-Sulawesi Selatan.',
            'is_read' => false,
        ]);
    }
}
