<?php
// Fungsi untuk mendapatkan nama hari dalam bahasa Indonesia
function getIndonesianDay($date)
{
    $day = date('l', strtotime($date));
    $days = array(
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    );
    return $days[$day];
}

// Fungsi untuk mendapatkan nama bulan dalam bahasa Indonesia
function getIndonesianMonth($date)
{
    $month = date('F', strtotime($date));
    $months = array(
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    );
    return $months[$month];
}
