<?php

namespace Tests\Feature\Sitemaps;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        if(file_exists(public_path(config('sitemap.file_name')))) {
            unlink(public_path(config('sitemap.file_name')));
        }
    }

    /**
     *@test
     */
    public function a_sitemap_is_generated_by_an_artisan_command()
    {
        $sitemap_file = public_path(config('sitemap.file_name'));
        $this->assertFalse(file_exists($sitemap_file));

        Artisan::call('sitemap:generate');

        $this->assertTrue(file_exists($sitemap_file));

        unlink($sitemap_file);
    }
}