<?php

namespace Database\Seeders;

use App\Models\TipePemasukan;
use Illuminate\Database\Seeder;

class TipePemasukanSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'nama' => 'Kotak Infaq Harian',
                'deskripsi' => 'Pemasukan dari kotak infaq yang disediakan di masjid untuk jamaah sehari-hari.'
            ],
            [
                'nama' => 'Infaq Jumat',
                'deskripsi' => 'Pemasukan dari kotak atau sumbangan khusus pada hari Jumat.'
            ],
            [
                'nama' => 'Donasi Program Khusus',
                'deskripsi' => 'Donasi untuk program tertentu seperti renovasi, pembelian lahan, atau pembangunan fasilitas.'
            ],
            [
                'nama' => 'Zakat Fitrah',
                'deskripsi' => 'Pemasukan dari zakat fitrah umat pada bulan Ramadan.'
            ],
            [
                'nama' => 'Zakat Mal',
                'deskripsi' => 'Penerimaan dari zakat harta yang dipercayakan ke masjid untuk disalurkan.'
            ],
            [
                'nama' => 'Dana Qurban',
                'deskripsi' => 'Dana yang dikumpulkan untuk pelaksanaan ibadah qurban.'
            ],
            [
                'nama' => 'Sumbangan Warga',
                'deskripsi' => 'Pemberian sukarela dari warga sekitar masjid di luar infaq rutin.'
            ],
            [
                'nama' => 'Transfer Bank',
                'deskripsi' => 'Pemasukan dana yang dikirim melalui rekening masjid.'
            ],
            [
                'nama' => 'Hasil Usaha Masjid',
                'deskripsi' => 'Pendapatan dari kegiatan ekonomi masjid seperti sewa toko atau kantin.'
            ],
            [
                'nama' => 'Sewa Aset Masjid',
                'deskripsi' => 'Pendapatan dari penyewaan aula, lapangan, atau perlengkapan milik masjid.'
            ],
            [
                'nama' => 'Bantuan Pemerintah',
                'deskripsi' => 'Dana bantuan dari instansi pemerintah untuk operasional atau pembangunan.'
            ],
            [
                'nama' => 'Bantuan Organisasi/LSM',
                'deskripsi' => 'Dana hibah dari lembaga sosial, LSM, atau yayasan.'
            ],
            [
                'nama' => 'Wakaf Uang',
                'deskripsi' => 'Dana wakaf dalam bentuk uang untuk kepentingan jangka panjang masjid.'
            ],
            [
                'nama' => 'Kegiatan Keagamaan',
                'deskripsi' => 'Pemasukan dari kegiatan seperti pengajian, pelatihan, atau bazar keagamaan.'
            ]
        ];

        foreach ($types as $type) {
            TipePemasukan::create($type);
        }
    }
}
