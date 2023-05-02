<?php
include('./koneksi.php');

session_start();
// Jika belum login, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: landing.php");
}

mysqli_query($connect, "SELECT * FROM userlogin");
$id_user = $_SESSION['id'];

if (isset($_POST['kirim'])) {
    // Mengambil data dari database
    $query = "SELECT * FROM tabeldata";
    $result = mysqli_query($connect, $query);

    // Menghitung jumlah total data pada liver_dataset4
    $total_data = mysqli_num_rows($result);

    // Mengambil data jumlah class pada tabelcluster
    $query = mysqli_query($connect, "SELECT * FROM tabeldata WHERE class = 0");
    $jml0_old = mysqli_num_rows($query);
    $query = mysqli_query($connect, "SELECT * FROM tabeldata WHERE class = 1");
    $jml1_old = mysqli_num_rows($query);

    $query = mysqli_query($connect, "SELECT jml FROM tabelcluster WHERE class = 0");
    $query2 = mysqli_fetch_array($query);
    $jml0 = $query2['jml'];
    $query = mysqli_query($connect, "SELECT jml FROM tabelcluster WHERE class = 1");
    $query2 = mysqli_fetch_array($query);
    $jml1 = $query2['jml'];

    $cekkmeans = $jml0_old != $jml0 && $jml1_old != $jml1;

    while ($cekkmeans) {
        $jml0_old = $jml0;
        $jml1_old = $jml1;

        // Loop through each row in the data table
        for ($i = 1; $i <= $total_data; $i++) {
            ini_set('max_execution_time', 600);

            $result = mysqli_query($connect, "SELECT alkphos, sgpt, sgot FROM tabeldata WHERE nomor = $i");
            $row = mysqli_fetch_assoc($result);
            $kolom1 = $row['alkphos'];
            $kolom2 = $row['sgpt'];
            $kolom3 = $row['sgot'];

            // Retrieve cluster centers for each class
            $result = mysqli_query($connect, "SELECT c1, c2, c3 FROM tabelcluster WHERE class = 0");
            $row = mysqli_fetch_assoc($result);
            $Center1Class1 = $row['c1'];
            $Center2Class1 = $row['c2'];
            $Center3Class1 = $row['c3'];

            $result = mysqli_query($connect, "SELECT c1, c2, c3 FROM tabelcluster WHERE class = 1");
            $row = mysqli_fetch_assoc($result);
            $Center1Class2 = $row['c1'];
            $Center2Class2 = $row['c2'];
            $Center3Class2 = $row['c3'];

            // Calculate distances between the data point and each cluster center
            $jarak0 = sqrt(pow($kolom1 - $Center1Class1, 2) + pow($kolom2 - $Center2Class1, 2) + pow($kolom3 - $Center3Class1, 2));
            $jarak1 = sqrt(pow($kolom1 - $Center1Class2, 2) + pow($kolom2 - $Center2Class2, 2) + pow($kolom3 - $Center3Class2, 2));

            // Determine the closest cluster center and assign the data point to the corresponding class
            $minimum = min($jarak0, $jarak1);
            if ($minimum == $jarak0) {
                $out = 0;
            } else {
                $out = 1;
            }

            // Insert the data point with its cluster assignments into the data table
            mysqli_query($connect, "UPDATE tabeldata SET alkphos = $kolom1, sgpt = $kolom2, sgot = $kolom3, c1 = $jarak0, c2 = $jarak1, class = $out WHERE nomor = $i");

            // Update cluster centers for each class
            $result = mysqli_query(
                $connect,
                "SELECT 
            (SELECT AVG(alkphos) FROM tabeldata WHERE class = 0) as avgC1,
            (SELECT AVG(sgpt) FROM tabeldata WHERE class = 0) as avgC2,
            (SELECT AVG(sgot) FROM tabeldata WHERE class = 0) as avgC3,
            (SELECT AVG(alkphos) FROM tabeldata WHERE class = 1) as avgC4,
            (SELECT AVG(sgpt) FROM tabeldata WHERE class = 1) as avgC5,
            (SELECT AVG(sgot) FROM tabeldata WHERE class = 1) as avgC6"
            );

            $row = mysqli_fetch_assoc($result);
            $avgC1 = $row['avgC1'];
            $avgC2 = $row['avgC2'];
            $avgC3 = $row['avgC3'];
            $avgC4 = $row['avgC4'];
            $avgC5 = $row['avgC5'];
            $avgC6 = $row['avgC6'];
        }

        $query = mysqli_query($connect, "SELECT * FROM tabeldata WHERE class = 0");
        $jml0 = mysqli_num_rows($query);

        $query = mysqli_query($connect, "SELECT * FROM tabeldata WHERE class = 1");
        $jml1 = mysqli_num_rows($query);

        mysqli_query($connect, "UPDATE tabelcluster SET c1 = $avgC1, c2 = $avgC2, c3 = $avgC3, jml = $jml0 WHERE class = 0");
        mysqli_query($connect, "UPDATE tabelcluster SET c1 = $avgC4, c2 = $avgC5, c3 = $avgC6, jml = $jml1 WHERE class = 1");
    }

    $result = mysqli_query(
        $connect,
        "SELECT 
    (SELECT AVG(alkphos) FROM tabeldata WHERE class = 0) as avgC1,
    (SELECT AVG(sgpt) FROM tabeldata WHERE class = 0) as avgC2,
    (SELECT AVG(sgot) FROM tabeldata WHERE class = 0) as avgC3,
    (SELECT AVG(alkphos) FROM tabeldata WHERE class = 1) as avgC4,
    (SELECT AVG(sgpt) FROM tabeldata WHERE class = 1) as avgC5,
    (SELECT AVG(sgot) FROM tabeldata WHERE class = 1) as avgC6"
    );

    $row = mysqli_fetch_assoc($result);
    $avgC1 = $row['avgC1'];
    $avgC2 = $row['avgC2'];
    $avgC3 = $row['avgC3'];
    $avgC4 = $row['avgC4'];
    $avgC5 = $row['avgC5'];
    $avgC6 = $row['avgC6'];

    $alkphos = $_POST['alkphos'];
    $sgpt = $_POST['sgpt'];
    $sgot = $_POST['sgot'];

    $jarak0 = sqrt(pow($alkphos - $avgC1, 2) + pow($sgpt - $avgC2, 2) + pow($sgot - $avgC3, 2));
    $jarak1 = sqrt(pow($alkphos - $avgC4, 2) + pow($sgpt - $avgC5, 2) + pow($sgot - $avgC6, 2));

    $minimum = min($jarak0, $jarak1);
    if ($minimum == $jarak0) {
        $out = 0;
    } else {
        $out = 1;
    }

    // Mendefinisikan nilai-nilai variabel
    $query = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND result = 1");
    $alkphos1 = mysqli_num_rows($query);
    $query = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND result = 1");
    $alkphos0 = mysqli_num_rows($query);
    $query = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE sgpt > 50 AND result = 1");
    $sgpt1 = mysqli_num_rows($query);
    $query = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE sgpt <= 50 AND result = 1");
    $sgpt0 = mysqli_num_rows($query);
    $query = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE sgot > 50 AND result = 1");
    $sgot1 = mysqli_num_rows($query);
    $query = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE sgot <= 50 AND result = 1");
    $sgot0 = mysqli_num_rows($query);
    $query = mysqli_query($connect, "SELECT * FROM liver_dataset4");
    $total = mysqli_num_rows($query);

    // Menghitung probabilitas prior
    $query = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE result = 1");
    $total1 = mysqli_num_rows($query);
    $p_liver = $total1 / $total;
    $query = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE result = 0");
    $total0 = mysqli_num_rows($query);
    $p_not_liver = $total0 / $total;

    // Menerima inputan dari user
    $alkphos = $_POST['alkphos'];
    $sgpt = $_POST['sgpt'];
    $sgot = $_POST['sgot'];

    // Memeriksa nilai inputan untuk setiap variabel independen
    if ($alkphos <= 200) {
        if ($sgpt <= 50) {
            if ($sgot <= 50) {
                // PELUANG RESULT = 1
                $alkphos_ya = $alkphos0 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND result = 1");
                $sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND sgot <= 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND result = 1");
                $sgot_sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_ya = $alkphos_ya * $sgpt_alkphos_ya * $sgot_sgpt_alkphos_ya;
                // PELUANG RESULT = 0
                $alkphos_tidak = $alkphos0 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND result = 0");
                $sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND sgot <= 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND result = 0");
                $sgot_sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_tidak = $alkphos_tidak * $sgpt_alkphos_tidak * $sgot_sgpt_alkphos_tidak;
                // PELUANG KONDISI TANPA MEMPERHATIKAN RESULT
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND sgot <= 50");
                $p_alkphos_sgpt_sgot = mysqli_num_rows($query) / $total;
            } elseif ($sgot > 50) {
                // PELUANG RESULT = 1
                $alkphos_ya = $alkphos0 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND result = 1");
                $sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND sgot > 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND result = 1");
                $sgot_sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_ya = $alkphos_ya * $sgpt_alkphos_ya * $sgot_sgpt_alkphos_ya;
                // PELUANG RESULT = 0
                $alkphos_tidak = $alkphos0 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND result = 0");
                $sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND sgot > 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND result = 0");
                $sgot_sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_tidak = $alkphos_tidak * $sgpt_alkphos_tidak * $sgot_sgpt_alkphos_tidak;
                // PELUANG KONDISI TANPA MEMPERHATIKAN RESULT
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt <= 50 AND sgot > 50");
                $p_alkphos_sgpt_sgot = mysqli_num_rows($query) / $total;
            }
        } elseif ($sgpt > 50) {
            if ($sgot <= 50) {
                // PELUANG RESULT = 1
                $alkphos_ya = $alkphos0 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND result = 1");
                $sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND sgot <= 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND result = 1");
                $sgot_sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_ya = $alkphos_ya * $sgpt_alkphos_ya * $sgot_sgpt_alkphos_ya;
                // PELUANG RESULT = 0
                $alkphos_tidak = $alkphos0 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND result = 0");
                $sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND sgot <= 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND result = 0");
                $sgot_sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_tidak = $alkphos_tidak * $sgpt_alkphos_tidak * $sgot_sgpt_alkphos_tidak;
                // PELUANG KONDISI TANPA MEMPERHATIKAN RESULT
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND sgot <= 50");
                $p_alkphos_sgpt_sgot = mysqli_num_rows($query) / $total;
            } elseif ($sgot > 50) {
                // PELUANG RESULT = 1
                $alkphos_ya = $alkphos0 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND result = 1");
                $sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND sgot > 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND result = 1");
                $sgot_sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_ya = $alkphos_ya * $sgpt_alkphos_ya * $sgot_sgpt_alkphos_ya;
                // PELUANG RESULT = 0
                $alkphos_tidak = $alkphos0 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND result = 0");
                $sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND sgot > 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND result = 0");
                $sgot_sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_tidak = $alkphos_tidak * $sgpt_alkphos_tidak * $sgot_sgpt_alkphos_tidak;
                // PELUANG KONDISI TANPA MEMPERHATIKAN RESULT
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos <= 200 AND sgpt > 50 AND sgot > 50");
                $p_alkphos_sgpt_sgot = mysqli_num_rows($query) / $total;
            }
        }
    } elseif ($alkphos > 200) {
        if ($sgpt <= 50) {
            if ($sgot <= 50) {
                // PELUANG RESULT = 1
                $alkphos_ya = $alkphos1 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND result = 1");
                $sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND sgot <= 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND result = 1");
                $sgot_sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_ya = $alkphos_ya * $sgpt_alkphos_ya * $sgot_sgpt_alkphos_ya;
                // PELUANG RESULT = 0
                $alkphos_tidak = $alkphos1 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND result = 0");
                $sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND sgot <= 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND result = 0");
                $sgot_sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_tidak = $alkphos_tidak * $sgpt_alkphos_tidak * $sgot_sgpt_alkphos_tidak;
                // PELUANG KONDISI TANPA MEMPERHATIKAN RESULT
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND sgot <= 50");
                $p_alkphos_sgpt_sgot = mysqli_num_rows($query) / $total;
            } elseif ($sgot > 50) {
                // PELUANG RESULT = 1
                $alkphos_ya = $alkphos1 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND result = 1");
                $sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND sgot > 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND result = 1");
                $sgot_sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_ya = $alkphos_ya * $sgpt_alkphos_ya * $sgot_sgpt_alkphos_ya;
                // PELUANG RESULT = 0
                $alkphos_tidak = $alkphos1 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND result = 0");
                $sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND sgot > 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND result = 0");
                $sgot_sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_tidak = $alkphos_tidak * $sgpt_alkphos_tidak * $sgot_sgpt_alkphos_tidak;
                // PELUANG KONDISI TANPA MEMPERHATIKAN RESULT
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt <= 50 AND sgot > 50");
                $p_alkphos_sgpt_sgot = mysqli_num_rows($query) / $total;
            }
        } elseif ($sgpt > 50) {
            if ($sgot <= 50) {
                // PELUANG RESULT = 1
                $alkphos_ya = $alkphos1 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND result = 1");
                $sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND sgot <= 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND result = 1");
                $sgot_sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_ya = $alkphos_ya * $sgpt_alkphos_ya * $sgot_sgpt_alkphos_ya;
                // PELUANG RESULT = 0
                $alkphos_tidak = $alkphos1 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND result = 0");
                $sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND sgot <= 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND result = 0");
                $sgot_sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_tidak = $alkphos_tidak * $sgpt_alkphos_tidak * $sgot_sgpt_alkphos_tidak;
                // PELUANG KONDISI TANPA MEMPERHATIKAN RESULT
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND sgot <= 50");
                $p_alkphos_sgpt_sgot = mysqli_num_rows($query) / $total;
            } elseif ($sgot > 50) {
                // PELUANG RESULT = 1
                $alkphos_ya = $alkphos1 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND result = 1");
                $sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND sgot > 50 AND result = 1");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND result = 1");
                $sgot_sgpt_alkphos_ya = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_ya = $alkphos_ya * $sgpt_alkphos_ya * $sgot_sgpt_alkphos_ya;
                // PELUANG RESULT = 0
                $alkphos_tidak = $alkphos1 / $total1;
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND result = 0");
                $sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND sgot > 50 AND result = 0");
                $query2 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND result = 0");
                $sgot_sgpt_alkphos_tidak = mysqli_num_rows($query1) / mysqli_num_rows($query2);
                $p_alkphos_sgpt_sgot_tidak = $alkphos_tidak * $sgpt_alkphos_tidak * $sgot_sgpt_alkphos_tidak;
                // PELUANG KONDISI TANPA MEMPERHATIKAN RESULT
                $query1 = mysqli_query($connect, "SELECT * FROM liver_dataset4 WHERE alkphos > 200 AND sgpt > 50 AND sgot > 50");
                $p_alkphos_sgpt_sgot = mysqli_num_rows($query) / $total;
            }
        }
    }

    // Menghitung probabilitas
    $probabilitas = ($p_alkphos_sgpt_sgot_ya * $p_alkphos_sgpt_sgot) / (($p_alkphos_sgpt_sgot_ya * $p_alkphos_sgpt_sgot) + ($p_alkphos_sgpt_sgot_tidak * $p_alkphos_sgpt_sgot));
    $persentase = $probabilitas * 100;

    if ($probabilitas <= 0.5) {
        $kemungkinan = 0;
    } else {
        $kemungkinan = 1;
    }

    date_default_timezone_set("Asia/Jakarta");
    $waktu = date('H:i:s');

    $sql = "INSERT INTO data_user (nama, id_user, alkphos, sgpt, sgot, tanggal, waktu, kmeans, bayes, persentase) 
    VALUES ('$_POST[nama]', $id_user, $alkphos, $sgpt, $sgot, '$_POST[tanggal]', '$waktu', $out, $kemungkinan, $persentase)";
    $sql = mysqli_query($connect, $sql);

    if ($sql) {
        echo "<script>
            alert('Simpan Sukses!');
            document.location='diagnosa.php';
        </script>";
    } else {
        echo "<script>
            alert('Simpan Gagal!');
            document.location-'formdiagnosa.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Screening</title>
    <link rel="shortcut icon" type="image/png" href="img/icon.png">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body style="background-image: url('img/bg1.jpg');">
    <!-- Navbar Start -->
    <div class="container-fluid bg-white shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
                <a href="index.php" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-info"><i class="fa fa-clinic-medical me-3"></i>LiverCare</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="formdiagnosa.php" class="nav-item nav-link active">Check up</a>
                        <a href="list.php" class="nav-item nav-link">Check up List</a>
                        <a href="index.php#article" class="nav-item nav-link">Article</a>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="index.php#about" class="dropdown-item">About</a>
                                <a href="index.php#service" class="dropdown-item">Service</a>
                                <a href="#blog" class="dropdown-item">Blog</a>
                                <br>
                                <a href="confussion.php" class="dropdown-item">Confussion Matriks</a>
                                <br>
                                <a href="#footer" class="dropdown-item">Contact</a>
                                <a href="logout.php" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="card-title text-white">Health Screening</h4>
            </div>
            <div class="card-content">
                <div class="card-body">

                    <form id="form" method="POST">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="nama">Nama </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-control" id="nama" name="nama" type="text" placeholder="Masukkan nama anda" aria-label="default input example" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="alkphos">Kadar Alkphos Alkaline Phosphotase</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" id="alkphos" name="alkphos" type="number" placeholder="Masukkan kadar alkphose dalam angka" aria-label="default input example" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="sgpt">Kadar SGPT</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" id="sgpt" name="sgpt" type="number" placeholder="Masukkan kadar SGPT dalam angka" aria-label="default input example" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="sgot">Kadar SGOT</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" id="sgot" name="sgot" type="number" placeholder="Masukkan kadar SGOT dalam angka" aria-label="default input example" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="tanggal">Tanggal Cek </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="tanggal" value="<?= date('d-m-Y'); ?>" readonly name="tanggal" class="form-control" aria-label="default input example" required>
                                    </div>
                                </div>
                            </div>
                            <center>
                                <div class="col col-4">
                                    <div class="d-grid gap-2 mt-5">
                                        <button class="btn btn-info" name="kirim" type="submit">Cek</button>
                                    </div>
                                </div>
                        </div>
                        </center>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </div>
</body>

</html>