<?php
function rambuLaluLintas() {
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
echo rambuLaluLintas() . "<br>"; // Output: merah
echo rambuLaluLintas() . "<br>"; // Output: kuning
echo rambuLaluLintas() . "<br>"; // Output: hijau
echo rambuLaluLintas() . "<br>"; // Output: merah
echo rambuLaluLintas() . "<br>";
?>