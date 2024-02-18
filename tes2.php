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
        public $daftarnilai;
        public function __construct($nrp, $nama) {
            $this->nrp = $nrp;
            $this->nama = $nama;
            $this->daftarnilai = [];
        }
        public function tambahNilai(Nilai $nilai) {
            if(count($this->daftarnilai) < 3) {
                $this->daftarnilai[] = $nilai;
                return true;
            } else {
                return false;
            }
        }
    }

    function generateRandomName($panjang = 10) {
        $karakter = 'abcdef';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $string .= $karakter[rand(0, strlen($karakter) - 1)];
        }
        return $string;
    }

    $daftarsiswa = [];
    for ($i = 0; $i < 10; $i++) {
        $nama = generateRandomName();
        $mapel = ["Inggris", "Indonesia", "Jepang"][rand(0, 2)];
        $nilai = rand(0, 100);
        $siswa = new Siswa($i + 1, $nama);
        $nilaisiswa = new Nilai($mapel, $nilai);
        $siswa->tambahNilai($nilaisiswa);
        $daftarsiswa[] = $siswa;
    }

    echo "<ol>";
    foreach ($daftarsiswa as $siswa) {
        echo "<li>";
        echo "NRP: " . $siswa->nrp . ", Nama: " . $siswa->nama . "<br>";
        echo "<ul>";
        foreach ($siswa->daftarnilai as $nilai) {
            echo "<li>Mata Pelajaran: " . $nilai->mapel . ", Nilai: " . $nilai->nilai . "</li>";
        }
        echo "</ul>";
        echo "</li>";
    }
    echo "</ol>";
    ?>
</body>
</html>
