<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LembagaDesa;

class LembagaDesaSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lembagaDesas = [
            [
                'nama_lembaga' => 'Badan Permusyawaratan Desa (BPD)',
                'deskripsi' => 'Lembaga yang menampung dan menyalurkan aspirasi masyarakat desa serta melakukan pengawasan terhadap penyelenggaraan pemerintahan desa.',
                'kontak' => '081234567890'
            ],
            [
                'nama_lembaga' => 'Lembaga Pemberdayaan Masyarakat (LPM)',
                'deskripsi' => 'Lembaga yang bertugas menyusun rencana pembangunan secara partisipatif, menggerakkan swadaya gotong royong masyarakat.',
                'kontak' => '081234567891'
            ],
            [
                'nama_lembaga' => 'Pemberdayaan Kesejahteraan Keluarga (PKK)',
                'deskripsi' => 'Organisasi kemasyarakatan yang memberdayakan perempuan untuk turut berpartisipasi dalam pembangunan Indonesia.',
                'kontak' => '081234567892'
            ],
            [
                'nama_lembaga' => 'Karang Taruna',
                'deskripsi' => 'Organisasi sosial kemasyarakatan sebagai wadah dan sarana pengembangan setiap anggota masyarakat yang tumbuh atas dasar kesadaran.',
                'kontak' => '081234567893'
            ],
            [
                'nama_lembaga' => 'Rukun Tetangga (RT)',
                'deskripsi' => 'Organisasi masyarakat yang diakui dan dibina oleh pemerintah untuk memelihara dan melestarikan nilai-nilai kehidupan masyarakat.',
                'kontak' => '081234567894'
            ],
            [
                'nama_lembaga' => 'Rukun Warga (RW)',
                'deskripsi' => 'Lembaga yang dibentuk oleh masyarakat melalui musyawarah masyarakat setempat dalam rangka pelayanan pemerintahan.',
                'kontak' => '081234567895'
            ],
            [
                'nama_lembaga' => 'Pos Pelayanan Terpadu (Posyandu)',
                'deskripsi' => 'Salah satu bentuk Upaya Kesehatan Bersumber Daya Masyarakat (UKBM) yang dikelola dan diselenggarakan dari, oleh, untuk dan bersama masyarakat.',
                'kontak' => '081234567896'
            ],
            [
                'nama_lembaga' => 'Kelompok Tani',
                'deskripsi' => 'Kumpulan petani/peternak/pekebun yang dibentuk atas dasar kesamaan kepentingan, kesamaan kondisi lingkungan sosial, ekonomi, sumberdaya.',
                'kontak' => '081234567897'
            ],
            [
                'nama_lembaga' => 'Lembaga Adat',
                'deskripsi' => 'Organisasi kemasyarakatan baik yang sengaja dibentuk maupun yang secara wajar telah tumbuh dan berkembang di dalam sejarah masyarakat.',
                'kontak' => '081234567898'
            ],
            [
                'nama_lembaga' => 'Kelompok Usaha Bersama (KUBE)',
                'deskripsi' => 'Himpunan keluarga miskin yang dibentuk, tumbuh, dan berkembang atas prakarsanya sendiri berdasarkan azas kesetiakawanan.',
                'kontak' => '081234567899'
            ],
            [
                'nama_lembaga' => 'Tim Penggerak PKK Desa',
                'deskripsi' => 'Tim yang bertugas menggerakkan dan membina kegiatan PKK di tingkat desa untuk meningkatkan kesejahteraan keluarga.',
                'kontak' => '081234567800'
            ],
            [
                'nama_lembaga' => 'Koperasi Desa',
                'deskripsi' => 'Badan usaha yang beranggotakan orang-seorang atau badan hukum koperasi dengan melandaskan kegiatannya berdasarkan prinsip koperasi.',
                'kontak' => '081234567801'
            ],
            [
                'nama_lembaga' => 'Kelompok Sadar Wisata (Pokdarwis)',
                'deskripsi' => 'Kelompok dari masyarakat yang peduli dan bertanggung jawab serta berperan sebagai penggerak dalam mendukung terciptanya iklim kondusif.',
                'kontak' => '081234567802'
            ],
            [
                'nama_lembaga' => 'Forum Anak Desa',
                'deskripsi' => 'Wadah partisipasi anak di tingkat desa yang dibentuk untuk menyuarakan kepentingan terbaik bagi anak.',
                'kontak' => '081234567803'
            ],
            [
                'nama_lembaga' => 'Kelompok Informasi Masyarakat (KIM)',
                'deskripsi' => 'Lembaga atau kelompok yang dibentuk dari, oleh, dan untuk masyarakat secara mandiri dan kreatif.',
                'kontak' => '081234567804'
            ],
            [
                'nama_lembaga' => 'Badan Usaha Milik Desa (BUMDes)',
                'deskripsi' => 'Badan usaha yang seluruh atau sebagian besar modalnya dimiliki oleh desa melalui penyertaan secara langsung.',
                'kontak' => '081234567805'
            ],
            [
                'nama_lembaga' => 'Kelompok Wanita Tani (KWT)',
                'deskripsi' => 'Kumpulan ibu-ibu tani yang tergabung dalam suatu kelompok untuk melakukan kegiatan pertanian bersama.',
                'kontak' => '081234567806'
            ],
            [
                'nama_lembaga' => 'Lembaga Keswadayaan Masyarakat (LKM)',
                'deskripsi' => 'Lembaga yang dibentuk atas prakarsa masyarakat sebagai mitra pemerintah desa dalam memberdayakan masyarakat.',
                'kontak' => '081234567807'
            ],
            [
                'nama_lembaga' => 'Kelompok Siaga Bencana',
                'deskripsi' => 'Kelompok masyarakat yang dibentuk untuk meningkatkan kesiapsiagaan dalam menghadapi bencana alam.',
                'kontak' => '081234567808'
            ],
            [
                'nama_lembaga' => 'Organisasi Kepemudaan Desa',
                'deskripsi' => 'Wadah pengembangan generasi muda yang tumbuh dan berkembang atas dasar kesadaran dan tanggung jawab sosial.',
                'kontak' => '081234567809'
            ]
        ];

        foreach ($lembagaDesas as $lembaga) {
            LembagaDesa::create($lembaga);
        }
    }
}