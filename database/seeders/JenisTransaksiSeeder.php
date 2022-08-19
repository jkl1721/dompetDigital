<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class JenisTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_transaksis')->insert([
            'nama_jenis' => 'Pemasukan'
        ]);
        DB::table('jenis_transaksis')->insert([
            'nama_jenis' => 'Pengeluaran'
        ]);
    }
}
