<?php

if (!function_exists('date_indo')) {
    function date_indo($date)
    {
        date_default_timezone_set('Asia/Makassar'); // UTC+8
        $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $dates = substr($date, 8, 2);
        $time = substr($date, 11, 5);
        $day = date("w", strtotime($date));

        // $result = $hari[$day] . ", " . $dates . " " . $bulan[(int)$month] . " " . $year . " " . $time;
        $result = $dates . " " . $bulan[(int)$month - 1] . " " . $year;
        return $result;
    }
}

if (!function_exists('month_indo')) {
    function month_indo($date)
    {
        date_default_timezone_set('Asia/Makassar'); // UTC+8
        $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $dates = substr($date, 8, 2);
        $time = substr($date, 11, 5);
        $day = date("w", strtotime($date));

        // $result = $hari[$day] . ", " . $dates . " " . $bulan[(int)$month] . " " . $year . " " . $time;
        $result = $bulan[(int)$month - 1] . " " . $year;
        return $result;
    }
}
