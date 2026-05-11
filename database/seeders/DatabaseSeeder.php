<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Users
        User::create([
            'name' => 'Afriza Nur Aini',
            'email' => 'afrizanuraini@gmail.com',
            'password' => bcrypt('Afriza123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Petugas PMR',
            'email' => 'petugas@uks.com',
            'password' => bcrypt('password'),
            'role' => 'petugas',
        ]);

        // 2. Create Kelas
        $kelas1 = \App\Models\Kelas::create(['nama_kelas' => 'X RPL 1']);
        $kelas2 = \App\Models\Kelas::create(['nama_kelas' => 'X TKJ 1']);
        $kelas3 = \App\Models\Kelas::create(['nama_kelas' => 'XI RPL 2']);

        // 3. Create Students
        $students = [
            ['nis' => '1001', 'nama' => 'Budi Santoso', 'kelas_id' => $kelas1->id, 'jk' => 'L'],
            ['nis' => '1002', 'nama' => 'Siti Aminah', 'kelas_id' => $kelas1->id, 'jk' => 'P'],
            ['nis' => '1003', 'nama' => 'Andi Wijaya', 'kelas_id' => $kelas2->id, 'jk' => 'L'],
            ['nis' => '1004', 'nama' => 'Rina Melati', 'kelas_id' => $kelas2->id, 'jk' => 'P'],
            ['nis' => '1005', 'nama' => 'Joko Anwar', 'kelas_id' => $kelas3->id, 'jk' => 'L'],
        ];

        foreach ($students as $s) {
            \App\Models\Student::create($s);
        }

        // 4. Create Medicines
        $medicines = [
            ['nama_obat' => 'Paracetamol 500mg', 'satuan' => 'Tablet', 'stok' => 50],
            ['nama_obat' => 'Amoxicillin 500mg', 'satuan' => 'Kapsul', 'stok' => 30],
            ['nama_obat' => 'Antasida Doen', 'satuan' => 'Tablet', 'stok' => 40],
            ['nama_obat' => 'Betadine 15ml', 'satuan' => 'Botol', 'stok' => 10],
            ['nama_obat' => 'Minyak Kayu Putih', 'satuan' => 'Botol', 'stok' => 15],
            ['nama_obat' => 'Tolak Angin', 'satuan' => 'Sachet', 'stok' => 25],
        ];

        foreach ($medicines as $m) {
            \App\Models\Medicine::create($m);
        }

        // 5. Create Dummy Treatments
        // To make the chart look good, create treatments in different months
        for ($i = 1; $i <= 12; $i++) {
            $numTreatments = rand(1, 5); // 1 to 5 visits per month
            for ($j = 0; $j < $numTreatments; $j++) {
                $treatment = \App\Models\Treatment::create([
                    'student_id' => rand(1, 5),
                    'keluhan' => 'Pusing dan mual ringan',
                    'diagnosa' => 'Gejala maag atau kelelahan',
                    'tanggal_kunjungan' => "2026-" . str_pad($i, 2, '0', STR_PAD_LEFT) . "-" . str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT),
                ]);

                // Attach some medicines randomly
                if (rand(0, 1) == 1) {
                    $medId = rand(1, 6);
                    $qty = rand(1, 2);
                    $treatment->medicines()->attach($medId, ['quantity' => $qty]);
                    // Note: We don't deduct stock here because this is just seeding past data, 
                    // or we could, but let's assume the seeded stock is the *current* stock.
                }
            }
        }
    }
}
