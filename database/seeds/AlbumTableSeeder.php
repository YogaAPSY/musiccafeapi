<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('album')->insert([
            [
                'nama_album' => "Berlyar",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_album' => "Musim yang baik",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nama_album' => "Kisah klasik untuk masa depan",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}
