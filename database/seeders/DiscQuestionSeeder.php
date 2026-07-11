<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            1 => [
                ['Mengelola waktu dengan efisien', 'C', '*'],
                ['Sering terburu-buru', 'D', 'D'],
                ['Mementingkan masalah sosial', 'I', 'I'],
                ['Suka menyelesaikan hal yang sudah dimulai', 'S', 'S']
            ],
            2 => [
                ['Penyemangat / pendukung yang baik', 'I', 'I'],
                ['Pendengar yang baik', 'S', 'S'],
                ['Penganalisa yang baik', 'C', 'C'],
                ['Pendelegasi yang baik / pandai membagi tugas', 'D', 'D']
            ],
            3 => [
                ['Non konfrontasi / mengalah', '*', 'S'],
                ['Penuh dengan hal-hal kecil / detail', 'C', '*'],
                ['Berubah pada menit-menit terakhir', 'I', 'I'],
                ['Mendesak / memaksa / sedikit kasar', 'D', 'D']
            ],
            4 => [
                ['Ramah, mudah berteman', 'S', '*'],
                ['Unik, bosan dengan rutinitas', '*', 'I'],
                ['Aktif membuat perubahan', 'D', 'D'],
                ['Ingin segala sesuatu akurat dan pasti', 'C', 'C']
            ],
            5 => [
                ['Menolak perubahan yang mendadak', 'S', '*'],
                ['Cenderung terlalu banyak berjanji', 'I', 'I'],
                ['Mundur apabila di bawah tekanan', '*', 'C'],
                ['Tidak takut berbeda / konfrontasi', '*', 'D']
            ],
            6 => [
                ['Menahan diri, bisa hidup tanpa memiliki', '*', 'C'],
                ['Membeli karena dorongan hasrat', 'D', 'D'],
                ['Akan menunggu dan tidak tetapkan', 'S', 'S'],
                ['Akan membeli apa yang diinginkan', 'I', '*']
            ],
            7 => [
                ['Menjadi Frustasi', 'C', 'C'],
                ['Memendam perasaan dalam hati', 'S', 'S'],
                ['Menyampaikan sudut pandang pribadi', '*', 'I'],
                ['Berani menghadapi oposisi / berlawanan', 'D', 'D']
            ],
            8 => [
                ['Menyenangkan orang lain', 'I', 'I'],
                ['Berusaha mencapai kesempurnaan', '*', 'C'],
                ['Menjadi bagian dari tim / kelompok', '*', 'S'],
                ['Ingin menetapkan goal / tujuan', 'D', '*']
            ],
            9 => [
                ['Mudah bergaul, ramah, mudah setuju', 'S', 'S'],
                ['Mempercayai, percaya pada orang lain', 'I', 'I'],
                ['Petualang, suka mengambil resiko', '*', 'D'],
                ['Penuh toleransi, menghormati orang lain', 'C', 'C']
            ],
            10 => [
                ['Peraturan perlu diuji', '*', 'D'],
                ['Peraturan membuat menjadi adil', 'C', '*'],
                ['Peraturan membuat menjadi membosankan', 'I', 'I'],
                ['Peraturan membuat menjadi aman', 'S', 'S']
            ],
            11 => [
                ['Lincah, banyak bicara', 'I', '*'],
                ['Cepat, penuh keyakinan', 'D', 'D'],
                ['Berusaha menjaga keseimbangan', 'S', 'S'],
                ['Berusaha patuh pada peraturan', '*', 'C']
            ],
            12 => [
                ['Mementingkan hasil', 'D', 'D'],
                ['Menegakkan dengan benar dan akurat', 'C', 'C'],
                ['Membuat pekerjaan jadi menyenangkan', '*', 'I'],
                ['Mari kerjakan bersama-sama', '*', 'S']
            ],
            13 => [
                ['Pendidikan, kebudayaan', '*', 'C'],
                ['Prestasi, penghargaan', 'D', 'D'],
                ['Keselamatan, keamanan', 'S', 'S'],
                ['Sosial, Pertemuan kelompok', 'I', '*']
            ],
            14 => [
                ['Menginginkan kekuasaan lebih', '*', 'D'],
                ['Menginginkan kesempatan baru', 'I', '*'],
                ['Menghindari perselisihan / konflik apapun', 'S', 'S'],
                ['Menginginkan arahan / petunjuk yang jelas', '*', 'C']
            ],
            15 => [
                ['Tenang, pendiam, tertutup', 'C', 'C'],
                ['Gembira, bebas, riang', 'I', 'I'],
                ['Menyenangkan, baik', 'S', '*'],
                ['Tegas, berani', 'D', 'D']
            ],
            16 => [
                ['Menyenangkan orang lain, ramah', 'S', 'S'],
                ['Tertawa lepas, hidup', '*', 'I'],
                ['Pemberani, tegas', 'D', 'D'],
                ['Pendiam, tertutup, tenang', 'C', 'C']
            ],
            17 => [
                ['Mengutamakan kemajuan / peningkatan', 'D', 'D'],
                ['Mudah merasa puas', 'S', '*'],
                ['Menunjukkan perasaan dengan terbuka', 'I', '*'],
                ['Rendah hati, sederhana', '*', 'C']
            ],
            18 => [
                ['Memikirkan orang lain dahulu', 'S', 'S'],
                ['Menyukai tantangan dan persaingan', 'D', 'D'],
                ['Optimis, berfikir positif', 'I', 'I'],
                ['Berfikir logis, sistematis', '*', 'C']
            ],
            19 => [
                ['Lembut, pendiam, tertutup', 'C', '*'],
                ['Optimis, visioner/pandangan ke masa depan', 'D', 'D'],
                ['Pusat perhatian, suka bersosialisasi', '*', 'I'],
                ['Pendamai, pembawa ketenangan', 'S', 'S']
            ],
            20 => [
                ['Menyediakan waktu untuk orang lain', 'S', 'S'],
                ['Penuh perencanaan dan persiapan diri', 'C', '*'],
                ['Melakukan petualangan', 'I', 'I'],
                ['Menerima penghargaan atas pencapaian target', 'D', 'D']
            ],
            21 => [
                ['Saya akan pimpin mereka', 'D', '*'],
                ['Saya mengikuti', 'S', 'S'],
                ['Saya akan bujuk mereka', 'I', '*'],
                ['Saya akan dapatkan faktanya', 'C', '*']
            ],
            22 => [
                ['Tidak mudah menyerah', 'D', 'D'],
                ['Melakukan sesuatu perintah', 'S', '*'],
                ['Bersemangat tinggi, ceria', 'I', 'I'],
                ['Ingin keteraturan, rapi', '*', 'C']
            ],
            23 => [
                ['Dapat dipercaya dan diandalkan', '*', 'S'],
                ['Kreatif, unik', 'I', '*'],
                ['Berorientasi pada hasil', 'D', '*'],
                ['Memegang teguh standar tinggi', 'C', '*']
            ],
            24 => [
                ['Pendekatan langsung dan tegas', 'D', 'D'],
                ['Suka bergaul, antusias', '*', 'I'],
                ['Mudah ditebak, konsisten', 'D', 'S'], // Catatan: gambar menunjukkan MOST: D, LEAST: S untuk opsi 3.
                ['Waspada, berhati-hati', 'C', '*']
            ],
        ];

        foreach ($questions as $qNum => $options) {
            $questionId = DB::table('disc_questions')->insertGetId([
                'question_number' => $qNum,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($options as $opt) {
                DB::table('disc_options')->insert([
                    'disc_question_id' => $questionId,
                    'option_text' => $opt[0],
                    'most_type' => $opt[1],
                    'least_type' => $opt[2],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
