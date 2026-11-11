<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Produk;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $staticUrls = collect([
            ['loc' => url('/'), 'lastmod' => null],
            ['loc' => route('profil'), 'lastmod' => null],
            ['loc' => route('berita.index'), 'lastmod' => null],
            ['loc' => route('belanja.umkm'), 'lastmod' => null],
            ['loc' => route('peta.desa'), 'lastmod' => null],
            ['loc' => route('infografis.penduduk'), 'lastmod' => null],
            ['loc' => route('infografis.apbdes'), 'lastmod' => null],
            ['loc' => route('infografis.stunting'), 'lastmod' => null],
            ['loc' => route('infografis.bansos'), 'lastmod' => null],
            ['loc' => route('infografis.idm'), 'lastmod' => null],
            ['loc' => route('infografis.sdgs'), 'lastmod' => null],
        ]);

        $newsUrls = Berita::query()
            ->where('status', 'published')
            ->get(['slug', 'updated_at'])
            ->map(fn (Berita $berita) => [
                'loc' => route('berita.show', $berita->slug),
                'lastmod' => $berita->updated_at,
            ]);

        $productUrls = Produk::query()
            ->whereNotNull('slug')
            ->get(['slug', 'updated_at'])
            ->map(fn (Produk $produk) => [
                'loc' => route('produk.show', $produk->slug),
                'lastmod' => $produk->updated_at,
            ]);

        return response()
            ->view('seo.sitemap', [
                'urls' => $staticUrls->concat($newsUrls)->concat($productUrls),
            ])
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
