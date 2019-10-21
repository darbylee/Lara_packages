<?php

namespace Pdusan\SimpleBlog\Seeds;

use DB;
use Illuminate\Database\Seeder;

class SBlogCategroyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('category')->insert([
            [
                'id' => 1,
                'title' => 'Fullstack',
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'title' => 'Backend',
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'title' => 'Frontend',
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'title' => 'App Developer',
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s')
            ],
        ]);
    }
}
