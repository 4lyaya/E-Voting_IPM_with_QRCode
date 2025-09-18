<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Events\StudentCreated;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        // $students = [
        //     ['nis' => '2025000001', 'name' => 'Budi Santoso', 'classroom' => 'X IPA 1'],
        //     ['nis' => '2025000002', 'name' => 'Siti Rahayu', 'classroom' => 'X IPA 1'],
        //     ['nis' => '2025000003', 'name' => 'Ahmad Fauzi', 'classroom' => 'X IPA 1'],
        //     ['nis' => '2025000004', 'name' => 'Dewi Lestari', 'classroom' => 'X IPA 1'],
        //     ['nis' => '2025000005', 'name' => 'Rudi Hermawan', 'classroom' => 'X IPA 1'],
        //     ['nis' => '2025000006', 'name' => 'Maya Sari', 'classroom' => 'X IPA 1'],
        //     ['nis' => '2025000007', 'name' => 'Joko Prasetyo', 'classroom' => 'X IPA 1'],
        //     ['nis' => '2025000008', 'name' => 'Rina Wulandari', 'classroom' => 'X IPA 1'],
        //     ['nis' => '2025000009', 'name' => 'Hendra Setiawan', 'classroom' => 'X IPA 1'],
        //     ['nis' => '2025000010', 'name' => 'Lia Agustina', 'classroom' => 'X IPA 1'],

        //     ['nis' => '2025000011', 'name' => 'Doni Saputra', 'classroom' => 'X IPA 2'],
        //     ['nis' => '2025000012', 'name' => 'Indah Permata', 'classroom' => 'X IPA 2'],
        //     ['nis' => '2025000013', 'name' => 'Arif Kurniawan', 'classroom' => 'X IPA 2'],
        //     ['nis' => '2025000014', 'name' => 'Sari Melati', 'classroom' => 'X IPA 2'],
        //     ['nis' => '2025000015', 'name' => 'Bayu Prasetya', 'classroom' => 'X IPA 2'],
        //     ['nis' => '2025000016', 'name' => 'Nina Kartika', 'classroom' => 'X IPA 2'],
        //     ['nis' => '2025000017', 'name' => 'Fajar Hidayat', 'classroom' => 'X IPA 2'],
        //     ['nis' => '2025000018', 'name' => 'Ratna Dewi', 'classroom' => 'X IPA 2'],
        //     ['nis' => '2025000019', 'name' => 'Andi Wijaya', 'classroom' => 'X IPA 2'],
        //     ['nis' => '2025000020', 'name' => 'Putri Anggraini', 'classroom' => 'X IPA 2'],

        //     ['nis' => '2025000021', 'name' => 'Yoga Pratama', 'classroom' => 'XI IPA 1'],
        //     ['nis' => '2025000022', 'name' => 'Dian Maharani', 'classroom' => 'XI IPA 1'],
        //     ['nis' => '2025000023', 'name' => 'Rizky Setiawan', 'classroom' => 'XI IPA 1'],
        //     ['nis' => '2025000024', 'name' => 'Ayu Lestari', 'classroom' => 'XI IPA 1'],
        //     ['nis' => '2025000025', 'name' => 'Tono Susilo', 'classroom' => 'XI IPA 1'],
        //     ['nis' => '2025000026', 'name' => 'Mega Wati', 'classroom' => 'XI IPA 1'],
        //     ['nis' => '2025000027', 'name' => 'Agus Salim', 'classroom' => 'XI IPA 1'],
        //     ['nis' => '2025000028', 'name' => 'Rosa Melinda', 'classroom' => 'XI IPA 1'],
        //     ['nis' => '2025000029', 'name' => 'Ilham Saputra', 'classroom' => 'XI IPA 1'],
        //     ['nis' => '2025000030', 'name' => 'Yuni Rahmawati', 'classroom' => 'XI IPA 1'],

        //     ['nis' => '2025000031', 'name' => 'Eko Santoso', 'classroom' => 'XI IPA 2'],
        //     ['nis' => '2025000032', 'name' => 'Fitri Handayani', 'classroom' => 'XI IPA 2'],
        //     ['nis' => '2025000033', 'name' => 'Galih Pradana', 'classroom' => 'XI IPA 2'],
        //     ['nis' => '2025000034', 'name' => 'Nur Aisyah', 'classroom' => 'XI IPA 2'],
        //     ['nis' => '2025000035', 'name' => 'Kiki Ramadhani', 'classroom' => 'XI IPA 2'],
        //     ['nis' => '2025000036', 'name' => 'Bagus Permadi', 'classroom' => 'XI IPA 2'],
        //     ['nis' => '2025000037', 'name' => 'Rani Oktaviani', 'classroom' => 'XI IPA 2'],
        //     ['nis' => '2025000038', 'name' => 'Dedi Firmansyah', 'classroom' => 'XI IPA 2'],
        //     ['nis' => '2025000039', 'name' => 'Salsa Amelia', 'classroom' => 'XI IPA 2'],
        //     ['nis' => '2025000040', 'name' => 'Bambang Susanto', 'classroom' => 'XI IPA 2'],

        //     ['nis' => '2025000041', 'name' => 'Citra Ayu', 'classroom' => 'XII IPA 1'],
        //     ['nis' => '2025000042', 'name' => 'Feriansyah Putra', 'classroom' => 'XII IPA 1'],
        //     ['nis' => '2025000043', 'name' => 'Hana Pratiwi', 'classroom' => 'XII IPA 1'],
        //     ['nis' => '2025000044', 'name' => 'Iqbal Ramadhan', 'classroom' => 'XII IPA 1'],
        //     ['nis' => '2025000045', 'name' => 'Lestari Puspita', 'classroom' => 'XII IPA 1'],
        //     ['nis' => '2025000046', 'name' => 'Rio Saputra', 'classroom' => 'XII IPA 1'],
        //     ['nis' => '2025000047', 'name' => 'Syifa Nuraini', 'classroom' => 'XII IPA 1'],
        //     ['nis' => '2025000048', 'name' => 'Tegar Maulana', 'classroom' => 'XII IPA 1'],
        //     ['nis' => '2025000049', 'name' => 'Winda Safitri', 'classroom' => 'XII IPA 1'],
        //     ['nis' => '2025000050', 'name' => 'Zaki Prasetya', 'classroom' => 'XII IPA 1'],
        // ];

        $students = [
            ['nis' => '2025000001', 'name' => 'Ahmad Adly Febryanto', 'classroom' => 'XII RPL 2'],
            ['nis' => '2025000002', 'name' => 'Ahmad Indra Darmawan', 'classroom' => 'XII RPL 1'],
            ['nis' => '2025000003', 'name' => 'Irsyadi Bagas', 'classroom' => 'XII RPL 2'],
            ['nis' => '2025000004', 'name' => 'Ainul Rohmah', 'classroom' => 'XII RPL 1'],
            ['nis' => '2025000005', 'name' => 'Zulfia Nirmala Putri', 'classroom' => 'XII RPL 1'],
        ];

        foreach ($students as $data) {
            $student = Student::firstOrCreate(
                ['nis' => $data['nis']], // kunci unik
                $data                     // data tambahan
            );

            if ($student->wasRecentlyCreated) {
                event(new StudentCreated($student));
            }
        }
    }
}
