<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{

    protected $signature = 'sitemap:generate';


    protected $description = 'Generates a fresh sitemap';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $sitemap_file = public_path(config('sitemap.file_name'));

        SitemapGenerator::create(config('app.url'))->writeToFile($sitemap_file);
    }
}
