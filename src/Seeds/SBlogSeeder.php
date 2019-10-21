<?php
namespace Pdusan\SimpleBlog\Seeds;

use Illuminate\Database\Seeder;

class SBlogSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SBlogCategroyTableSeeder::class,
        ]);
    }
}
