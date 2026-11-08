<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebBemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_home_page_is_accessible_and_renders_identity(): void
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSee('BEM STIKS');
        $response->assertSee('Tamalanrea Makassar');
        $response->assertSee('Ruang Berkarya, Bergerak, dan Mengabdi');
    }

    public function test_about_page_is_accessible(): void
    {
        $response = $this->get(route('about'));
        $response->assertStatus(200);
        $response->assertSee('Mengenal BEM STIKS Tamalanrea');
        $response->assertSee('Filosofi Logo');
    }

    public function test_posts_index_is_accessible(): void
    {
        $response = $this->get(route('posts.index'));
        $response->assertStatus(200);
        $response->assertSee('Kanal Informasi Resmi');
        $response->assertSee('Berita &amp; Kegiatan', false);
    }

    public function test_post_detail_page_is_accessible(): void
    {
        $post = Post::published()->first();
        $this->assertNotNull($post);

        $response = $this->get(route('posts.show', $post->slug));
        $response->assertStatus(200);
        $response->assertSee($post->title);
    }

    public function test_information_center_tabs_are_accessible(): void
    {
        $tabs = ['proker', 'kalender', 'timeline', 'dokumentasi', 'aspirasi'];

        foreach ($tabs as $tab) {
            $response = $this->get(route('information.index', ['tab' => $tab]));
            $response->assertStatus(200);
        }
    }

    public function test_student_can_submit_aspiration_and_receive_tracking_code(): void
    {
        $response = $this->post(route('aspirations.store'), [
            'is_anonymous' => 0,
            'name' => 'Fauzi Ramadhan',
            'nim' => '23.01.099',
            'study_program' => 'S1 Ilmu Kesejahteraan Sosial',
            'phone' => '081234567899',
            'topic' => 'Fasilitas Kampus',
            'subject' => 'Permohonan Pengadaan Koleksi Buku Referensi Kesejahteraan Sosial',
            'content' => 'Mohon bantuan rekan-rekan BEM untuk mengusulkan penambahan buku teks pekerjaan sosial terbaru di perpustakaan kampus.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('aspiration_success', true);
        $this->assertDatabaseHas('aspirations', [
            'nim' => '23.01.099',
            'subject' => 'Permohonan Pengadaan Koleksi Buku Referensi Kesejahteraan Sosial',
        ]);
    }

    public function test_student_can_track_aspiration(): void
    {
        $response = $this->get(route('aspirations.track', ['code' => 'ASP-20261108-001']));
        $response->assertStatus(200);
        $response->assertSee('ASP-20261108-001');
    }

    public function test_contact_page_is_accessible_and_accepts_messages(): void
    {
        $response = $this->get(route('contact.index'));
        $response->assertStatus(200);
        $response->assertSee('Hubungi Sekretariat BEM');

        $sendResponse = $this->post(route('contact.send'), [
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@example.com',
            'phone' => '081299887766',
            'subject' => 'Permohonan Kunjungan Lapangan',
            'message' => 'Halo BEM STIKS, kami ingin bersilaturahmi dan berdiskusi program kemitraan sosial.',
        ]);

        $sendResponse->assertRedirect(route('contact.index'));
        $sendResponse->assertSessionHas('contact_success');
        $this->assertDatabaseHas('messages', [
            'email' => 'budi.santoso@example.com',
        ]);
    }

    public function test_admin_guest_redirected_to_login(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_login_and_access_dashboard(): void
    {
        $loginResponse = $this->post(route('admin.login.submit'), [
            'email' => 'superadmin@stikstamalanrea.ac.id',
            'password' => 'password123',
        ]);

        $loginResponse->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticated();

        $dashResponse = $this->get(route('admin.dashboard'));
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Dashboard Administrasi');
    }

    public function test_admin_can_create_post(): void
    {
        $admin = User::where('role', 'super_admin')->first();
        $this->actingAs($admin);

        $response = $this->post(route('admin.posts.store'), [
            'category_id' => 1,
            'title' => 'Uji Publikasi Berita Otomatis',
            'excerpt' => 'Ringkasan berita uji publikasi.',
            'content' => 'Konten lengkap untuk pengujian publikasi berita.',
            'status' => 'published',
        ]);

        $response->assertRedirect(route('admin.posts.index'));
        $this->assertDatabaseHas('posts', [
            'title' => 'Uji Publikasi Berita Otomatis',
            'slug' => 'uji-publikasi-berita-otomatis',
        ]);
    }

    public function test_non_existent_page_renders_custom_404_page(): void
    {
        $response = $this->get('/halaman-yang-pasti-tidak-ada-123');
        $response->assertStatus(404);
        $response->assertSee('404');
        $response->assertSee('Halaman Tidak Ditemukan');
    }

    public function test_regular_admin_forbidden_from_user_management(): void
    {
        $regularAdmin = User::where('role', 'admin')->first();
        $this->actingAs($regularAdmin);

        $response = $this->get(route('admin.users.index'));
        $response->assertStatus(403);
        $response->assertSee('403');
        $response->assertSee('Akses Dibatasi');
    }
}
