<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class KarhutlaSeeder extends Seeder
{
    public function run(): void
    {
        $pelapor = User::updateOrCreate(
            ['email' => 'pelapor@karhutla.test'],
            [
                'name' => 'Demo Pelapor',
                'password' => 'password123',
                'role' => 'pelapor',
            ]
        );

        $relawan = User::updateOrCreate(
            ['email' => 'relawan@karhutla.test'],
            [
                'name' => 'Demo Relawan',
                'password' => 'password123',
                'role' => 'relawan',
            ]
        );

        User::updateOrCreate(
            ['email' => 'koordinator@karhutla.test'],
            [
                'name' => 'Demo Koordinator',
                'password' => 'password123',
                'role' => 'koordinator',
            ]
        );

        $areaSungai = Area::firstOrCreate([
            'name' => 'Kecamatan Sungai Raya',
        ]);

        $areaBukit = Area::firstOrCreate([
            'name' => 'Kecamatan Bukit Lestari',
        ]);

        $areaRawa = Area::firstOrCreate([
            'name' => 'Kecamatan Rawa Makmur',
        ]);

        $simpanLaporan = function (array $data): void {
            $report = Report::firstOrNew([
                'description' => $data['description'],
            ]);

            $report->fill([
                'area_id' => $data['area_id'],
                'occurred_at' => $data['occurred_at'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'condition_level' => $data['condition_level'],
                'evidence_path' => null,
            ]);

            $report->reporter_id = $data['reporter_id'];
            $report->status = $data['status'];
            $report->reviewer_id = $data['reviewer_id'] ?? null;
            $report->review_note = $data['review_note'] ?? null;
            $report->forwarded_to = $data['forwarded_to'] ?? null;
            $report->forwarded_at = $data['forwarded_at'] ?? null;
            $report->closed_at = $data['closed_at'] ?? null;

            $report->save();
        };

        $simpanLaporan([
            'description' => 'Asap tipis terlihat di dekat area kebun.',
            'area_id' => $areaSungai->id,
            'occurred_at' => now()->subHours(2),
            'latitude' => -2.1000000,
            'longitude' => 113.9000000,
            'condition_level' => 'rendah',
            'reporter_id' => $pelapor->id,
            'status' => 'baru',
        ]);

        $simpanLaporan([
            'description' => 'Asap terlihat dari tepi jalan menuju kawasan hutan.',
            'area_id' => $areaBukit->id,
            'occurred_at' => now()->subHours(5),
            'latitude' => -2.2000000,
            'longitude' => 113.8000000,
            'condition_level' => 'sedang',
            'reporter_id' => $pelapor->id,
            'status' => 'ditinjau',
            'reviewer_id' => $relawan->id,
            'review_note' => 'Lokasi dan waktu laporan sudah diperiksa.',
        ]);

        $simpanLaporan([
            'description' => 'Asap tebal terlihat dari beberapa titik di lahan terbuka.',
            'area_id' => $areaRawa->id,
            'occurred_at' => now()->subDay(),
            'latitude' => -2.3000000,
            'longitude' => 113.7000000,
            'condition_level' => 'tinggi',
            'reporter_id' => $pelapor->id,
            'status' => 'perlu_diteruskan',
            'reviewer_id' => $relawan->id,
            'review_note' => 'Informasi perlu diteruskan untuk perhatian lebih lanjut.',
        ]);

        $simpanLaporan([
            'description' => 'Asap terlihat di dekat area semak.',
            'area_id' => $areaSungai->id,
            'occurred_at' => now()->subDays(2),
            'latitude' => -2.1500000,
            'longitude' => 113.9500000,
            'condition_level' => 'sedang',
            'reporter_id' => $pelapor->id,
            'status' => 'diteruskan',
            'reviewer_id' => $relawan->id,
            'review_note' => 'Informasi sudah diperiksa dan perlu diteruskan.',
            'forwarded_to' => 'BPBD Kabupaten',
            'forwarded_at' => now()->subDay(),
        ]);

        $simpanLaporan([
            'description' => 'Laporan asap yang proses komunitasnya sudah selesai.',
            'area_id' => $areaBukit->id,
            'occurred_at' => now()->subDays(3),
            'latitude' => -2.2500000,
            'longitude' => 113.8500000,
            'condition_level' => 'rendah',
            'reporter_id' => $pelapor->id,
            'status' => 'selesai',
            'reviewer_id' => $relawan->id,
            'review_note' => 'Proses pemantauan komunitas selesai.',
            'forwarded_to' => 'Pengelola kawasan',
            'forwarded_at' => now()->subDays(2),
            'closed_at' => now()->subDay(),
        ]);
    }
}
