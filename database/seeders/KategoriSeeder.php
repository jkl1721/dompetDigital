<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Gaji',
            'id_jenis' => 1
        ]);
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Tunjangan',
            'id_jenis' => 1
        ]);
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Bunga',
            'id_jenis' => 1
        ]);
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Hutang/Piutang',
            'id_jenis' => 1
        ]);
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Lain-lain',
            'id_jenis' => 1
        ]);
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Makanan/Minuman',
            'id_jenis' => 2
        ]);
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Transportasi',
            'id_jenis' => 2
        ]);
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Belanja',
            'id_jenis' => 2
        ]);
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Hutang/Piutang',
            'id_jenis' => 2
        ]);
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Lain-lain',
            'id_jenis' => 2
        ]);
    }
}
