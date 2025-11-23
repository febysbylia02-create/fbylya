<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuratKeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('surat_keluar')->insert([
            [
                'nomor_urut' => '001/789',
                'nomor_berkas' => '001/789',
                'tanggal_surat' => '2025-10-01',
                'perihal' => 'Permohonan Bantuan Dana Operasional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '002/789',
                'nomor_berkas' => '002/789',
                'tanggal_surat' => '2025-10-03',
                'perihal' => 'Laporan Kegiatan Bulanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '003/789',
                'nomor_berkas' => '003/789',
                'tanggal_surat' => '2025-10-05',
                'perihal' => 'Undangan Seminar Nasional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '004/789',
                'nomor_berkas' => '004/789',
                'tanggal_surat' => '2025-10-07',
                'perihal' => 'Permohonan Penambahan Daya Listrik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '005/789',
                'nomor_berkas' => '005/789',
                'tanggal_surat' => '2025-10-10',
                'perihal' => 'Pemberitahuan Program Desa Mandiri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '006/789',
                'nomor_berkas' => '006/789',
                'tanggal_surat' => '2025-10-12',
                'perihal' => 'Proposal Kerjasama Pendidikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '007/789',
                'nomor_berkas' => '007/789',
                'tanggal_surat' => '2025-10-15',
                'perihal' => 'Permohonan Dukungan Medis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '008/789',
                'nomor_berkas' => '008/789',
                'tanggal_surat' => '2025-10-18',
                'perihal' => 'Permohonan Pengiriman Dokumen Penting',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '009/789',
                'nomor_berkas' => '009/789',
                'tanggal_surat' => '2025-10-20',
                'perihal' => 'Laporan Kondisi Jalan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '010/789',
                'nomor_berkas' => '010/789',
                'tanggal_surat' => '2025-10-22',
                'perihal' => 'Permohonan Izin Kunjungan Lapangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '011/789',
                'nomor_berkas' => '011/789',
                'tanggal_surat' => '2025-10-25',
                'perihal' => 'Laporan Kegiatan Sosial Kemasyarakatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '012/789',
                'nomor_berkas' => '012/789',
                'tanggal_surat' => '2025-10-27',
                'perihal' => 'Laporan Pemantauan Kualitas Udara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '013/789',
                'nomor_berkas' => '013/789',
                'tanggal_surat' => '2025-10-29',
                'perihal' => 'Permohonan Bantuan Alat Peraga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '014/789',
                'nomor_berkas' => '014/789',
                'tanggal_surat' => '2025-11-01',
                'perihal' => 'Permohonan Legalisasi Dokumen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '015/789',
                'nomor_berkas' => '015/789',
                'tanggal_surat' => '2025-11-03',
                'perihal' => 'Permohonan Rekening Baru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '016/789',
                'nomor_berkas' => '016/789',
                'tanggal_surat' => '2025-11-05',
                'perihal' => 'Undangan Rapat Koordinasi Guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '017/789',
                'nomor_berkas' => '017/789',
                'tanggal_surat' => '2025-11-08',
                'perihal' => 'Laporan Stok Obat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '018/789',
                'nomor_berkas' => '018/789',
                'tanggal_surat' => '2025-11-10',
                'perihal' => 'Permohonan Informasi Visa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '019/789',
                'nomor_berkas' => '019/789',
                'tanggal_surat' => '2025-11-12',
                'perihal' => 'Permohonan Bantuan Praktik Kerja Industri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_urut' => '020/789',
                'nomor_berkas' => '020/789',
                'tanggal_surat' => '2025-11-15',
                'perihal' => 'Permohonan Akses Server Lokal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}