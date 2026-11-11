<?php

namespace Tests\Feature;

use App\Models\Bansos;
use App\Models\Berita;
use App\Models\ContactSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Public pages should render with an empty database.
     */
    public function test_public_pages_return_successful_responses(): void
    {
        foreach ([
            '/',
            '/profil',
            '/berita',
            '/belanja-umkm',
            '/peta-desa',
            '/infografis/penduduk',
            '/infografis/apbdes',
            '/infografis/stunting',
            '/infografis/bansos',
            '/infografis/idm',
            '/infografis/sdgs',
        ] as $uri) {
            $this->get($uri)->assertOk();
        }

        $this->get('/peta-desa')
            ->assertSee('leaflet.css', false)
            ->assertSee('leaflet.js', false);
    }

    public function test_homepage_and_news_details_only_expose_published_news(): void
    {
        Berita::create([
            'judul' => 'Berita Publik',
            'slug' => 'berita-publik',
            'isi' => 'Informasi yang sudah dipublikasikan.',
            'status' => 'published',
        ]);
        Berita::create([
            'judul' => 'Berita Draft Rahasia',
            'slug' => 'berita-draft-rahasia',
            'isi' => 'Konten yang belum dipublikasikan.',
            'status' => 'draft',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Berita Publik')
            ->assertDontSee('Berita Draft Rahasia');

        $this->get('/berita/berita-publik')->assertOk();
        $this->get('/berita/berita-draft-rahasia')->assertNotFound();
    }

    public function test_bansos_page_filters_recap_data_by_selected_year(): void
    {
        Bansos::create([
            'tahun' => 2024,
            'jenis_bansos' => 'Bantuan Tahun 2024',
            'jumlah_penerima' => 10,
        ]);
        Bansos::create([
            'tahun' => 2025,
            'jenis_bansos' => 'Bantuan Tahun 2025',
            'jumlah_penerima' => 20,
        ]);

        $this->get('/infografis/bansos?tahun=2024')
            ->assertOk()
            ->assertSee('Bantuan Tahun 2024')
            ->assertDontSee('Bantuan Tahun 2025');
    }

    public function test_contact_details_and_social_links_are_read_from_settings(): void
    {
        ContactSetting::query()->findOrFail(1)->update([
            'address' => 'Alamat Baru',
            'phone' => '+62 812-3456-7890',
            'whatsapp_number' => '0812-3456-7890',
            'email' => 'kontak@example.com',
            'facebook_url' => 'https://facebook.com/desa',
            'instagram_url' => 'https://instagram.com/desa',
            'youtube_url' => 'https://youtube.com/@desa',
            'tiktok_url' => 'https://www.tiktok.com/@desa',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Alamat Baru')
            ->assertSee('href="tel:+6281234567890"', false)
            ->assertSee('href="mailto:kontak@example.com"', false)
            ->assertSee('href="https://wa.me/6281234567890"', false)
            ->assertSee('href="https://facebook.com/desa"', false)
            ->assertSee('href="https://instagram.com/desa"', false)
            ->assertSee('href="https://youtube.com/@desa"', false)
            ->assertSee('href="https://www.tiktok.com/@desa"', false);

        $this->get('/profil')
            ->assertOk()
            ->assertSee('href="https://wa.me/6281234567890"', false);
    }

    public function test_admin_contact_settings_page_is_available_to_authenticated_users(): void
    {
        $this->actingAs(User::factory()->create())
            ->get('/admin/contact-settings')
            ->assertOk()
            ->assertSee('Nomor WhatsApp')
            ->assertSee('TikTok')
            ->assertSee('Simpan Pengaturan');
    }

    public function test_dashboard_shows_welcome_card_before_year_filter(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin')
            ->assertOk()
            ->assertSeeInOrder([
                'fi-page-header-widgets',
                'Periode Tahun',
            ]);
    }

    public function test_admin_login_is_in_the_footer_not_the_public_header(): void
    {
        $response = $this->get('/');
        $response->assertOk()
            ->assertSee('<a href="/admin" class="footer-link">Login Admin</a>', false);

        $html = $response->getContent();
        $headerStart = strpos($html, '<nav');
        $headerEnd = strpos($html, '</nav>', $headerStart);

        $this->assertNotFalse($headerStart);
        $this->assertNotFalse($headerEnd);
        $this->assertStringNotContainsString(
            'Login Admin',
            substr($html, $headerStart, $headerEnd - $headerStart)
        );
    }
}
