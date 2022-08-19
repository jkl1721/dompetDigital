<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksis')->insert([
            'id_transaksi' => 'GhkanAU2',
            'id_user' => 2,
            'id_jenis' => 1,
            'id_kategori' => 1,
            'tanggal' => '2022-01-01',
            'nominal' => 1000000,
            'keterangan' => 'Gaji',
            'is_approved' => 0,
            'created_at' => '2022-01-01',
            'updated_at' => '2022-01-01'
        ]);
        DB::table('transaksis')->insert([
            'id_transaksi' => 'Gh4tnAU2',
            'id_user' => 2,
            'id_jenis' => 2,
            'id_kategori' => 6,
            'tanggal' => '2022-01-01',
            'nominal' => 200000,
            'keterangan' => 'Gyukaku',
            'is_approved' => 0,
            'created_at' => '2022-01-01',
            'updated_at' => '2022-01-01'
        ]);
    }
}
