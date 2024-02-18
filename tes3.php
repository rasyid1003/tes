<?php
function rambu() {
    static $warna = [
        'merah',
        'kuning',
        'hijau'
    ];
    static $index = 0;

    $color = $warna[$index];
    $index = ($index + 1) % count($warna);

    return $color;
}
echo rambu() . "<br>"; // Output: merah
echo rambu() . "<br>"; // Output: kuning
echo rambu() . "<br>"; // Output: hijau
echo rambu() . "<br>"; // Output: merah
echo rambu() . "<br>";
?>