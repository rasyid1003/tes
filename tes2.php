<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
</head>
<body>
    <h1>Data Siswa</h1>

    <?php
    class Nilai {
        public $mapel;
        public $nilai;

        public function __construct($mapel, $nilai) {
            $this->mapel = $mapel;
            $this->nilai = $nilai;
        }
    }

    class Siswa {
        public $nrp;
        public $nama;
        public $daftarNilai;

        public function __construct($nrp, $nama) {
            $this->nrp = $nrp;
            $this->nama = $nama;
            $this->daftarNilai = [];
        }

        public function tambahNilai(Nilai $nilai) {
            if(count($this->daftarNilai) < 3) {
                $this->daftarNilai[] = $nilai;
                return true;
            } else {
                return false; // Jika daftarNilai sudah penuh
            }
        }
    }

    function generateRandomName($length = 10) {
        $characters = 'abcdef';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    $daftarSiswa = [];
    for ($i = 0; $i < 10; $i++) {
        $nama = generateRandomName();
        $mapel = ["Inggris", "Indonesia", "Jepang"][rand(0, 2)];
        $nilai = rand(0, 100);
        $siswa = new Siswa($i + 1, $nama);
        $nilaiSiswa = new Nilai($mapel, $nilai);
        $siswa->tambahNilai($nilaiSiswa);
        $daftarSiswa[] = $siswa;
    }

    echo "<ol>";
    foreach ($daftarSiswa as $siswa) {
        echo "<li>";
        echo "NRP: " . $siswa->nrp . ", Nama: " . $siswa->nama . "<br>";
        echo "<ul>";
        foreach ($siswa->daftarNilai as $nilai) {
            echo "<li>Mata Pelajaran: " . $nilai->mapel . ", Nilai: " . $nilai->nilai . "</li>";
        }
        echo "</ul>";
        echo "</li>";
    }
    echo "</ol>";
    ?>
</body>
</html>
