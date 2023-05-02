<?php
include('./koneksi.php');

$kmeansTP = 0;
$kmeansTN = 0;
$kmeansFP = 0;
$kmeansFN = 0;

$bayesTP = 0;
$bayesTN = 0;
$bayesFP = 0;
$bayesFN = 0;

for ($i = 1; $i <= 100; $i++) {
    $query = mysqli_query($connect, "SELECT * FROM testing WHERE id = $i");
    $row = mysqli_fetch_assoc($query);
    $result = $row['result'];
    $kmeans = $row['kmeans'];
    $bayes = $row['bayes'];

    if ($result == 1 and $kmeans == 1) {
        $kmeansTP++;
    } elseif ($result == 0 and $kmeans == 0) {
        $kmeansTN++;
    } elseif ($result == 0 and $kmeans == 1) {
        $kmeansFP++;
    } elseif ($result == 1 and $kmeans == 0) {
        $kmeansFN++;
    }

    if ($result == 1 and $bayes == 1) {
        $bayesTP++;
    } elseif ($result == 0 and $bayes == 0) {
        $bayesTN++;
    } elseif ($result == 0 and $bayes == 1) {
        $bayesFP++;
    } elseif ($result == 1 and $bayes == 0) {
        $bayesFN++;
    }
}

$totalKmeans = $kmeansTP + $kmeansTN + $kmeansFP + $kmeansFN;
$totalBayes = $bayesTP + $bayesTN + $bayesFP + $bayesFN;

if ($totalKmeans > 0) {
    $akurasiKmeans = (($kmeansTP + $kmeansTN) / $totalKmeans) * 100;
    $presisiKmeans = ($kmeansTP / ($kmeansTP + $kmeansFP)) * 100;
    $recallKmeans = ($kmeansTP / ($kmeansTP + $kmeansFN)) * 100;
    $pKmeans = ($kmeansTP + $kmeansTN) / $totalKmeans;
} else {
    "Tidak ada akurasi untuk KMeans";
}

if ($totalBayes > 0) {
    $akurasiBayes = (($bayesTP + $bayesTN) / $totalBayes) * 100;
    $presisiBayes = ($bayesTP / ($bayesTP + $bayesFP)) * 100;
    $recallBayes = ($bayesTP / ($bayesTP + $bayesFN)) * 100;
    $pBayes = ($bayesTP + $bayesTN) / $totalBayes;
} else {
    "Tidak ada akurasi untuk KMeans";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confussion Matriks</title>
    <link rel="shortcut icon" type="image/png" href="img/icon.png">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <!-- Navbar Start -->
    <div class="container-fluid bg-white shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
                <a href="index.php" class="navbar-brand">
                    <h1 class="m-0 text-upperca se text-info"><i class="fa fa-clinic-medical me-3"></i>LiverCare</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="formdiagnosa.php" class="nav-item nav-link">Check up</a>
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

    <div class="container">

        <div class="table-responsive mt-5 col-lg-12 text-center">
            <h3>Tabel Perbandingan Data Aktual dan Prediksi</h3>
            <table class="table table-bordered">
                <tr class="table-info align-middle text-center">
                    <th>Keterangan</th>
                    <th>Kmeans</th>
                    <th>Bayes</th>
                </tr>
                <tr>
                    <td>True Positive (TP)</td>
                    <td><?= $kmeansTP ?></td>
                    <td><?= $bayesTP ?></td>
                </tr>
                <tr>
                    <td>True Negative (TN)</td>
                    <td><?= $kmeansTN ?></td>
                    <td><?= $bayesTN ?></td>
                </tr>
                <tr>
                    <td>False Positive (FP)</td>
                    <td><?= $kmeansFP ?></td>
                    <td><?= $bayesFP ?></td>
                </tr>
                <tr>
                    <td>False Negative (FN)</td>
                    <td><?= $kmeansFN ?></td>
                    <td><?= $bayesFN ?></td>
                </tr>
            </table>
        </div>

        <div class="table-responsive mt-5 col-lg-12 text-center">
            <h3>Tabel Confussion Matriks</h3>

            <table class="my-3 table table-bordered">
                <tr class="table-info align-middle text-center">
                    <th>Confusion Matrix</th>
                    <th>Kmeans</th>
                    <th>Bayes</th>
                </tr>
                <tr>
                    <td>Akurasi</td>
                    <td><?= $akurasiKmeans ?> %</td>
                    <td><?= $akurasiBayes ?> %</td>
                </tr>
                <tr>
                    <td>Presisi</td>
                    <td><?= $presisiKmeans ?> %</td>
                    <td><?= $presisiBayes ?> %</td>
                </tr>
                <tr>
                    <td>Recall</td>
                    <td><?= $recallKmeans ?> %</td>
                    <td><?= $recallBayes ?> %</td>
                </tr>
                <tr>
                    <td>Peluang</td>
                    <td><?= $pKmeans ?></td>
                    <td><?= $pBayes ?></td>
                </tr>
            </table>
        </div>

        <div class="table-responsive mt-5 col-lg-12 text-center">
            <center>
                <h3 class="mt-4 text-center">Tabel Testing</h3>
            </center>
            <table class="my-3 table table-bordered">
                <tr class="table-info align-middle text-center">
                    <th>No</th>
                    <th>Alkphos</th>
                    <th>Sgpt</th>
                    <th>Sgot</th>
                    <th>Result</th>
                    <th>Kmeans</th>
                    <th>Bayes</th>
                    <th>Keterangan Kmeans</th>
                    <th>Keterangan Bayes</th>
                </tr>
                <?php
                $no = 1;
                $baris = mysqli_query($connect, "SELECT * FROM testing");
                while ($row = mysqli_fetch_assoc($baris)) :
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['alkphos'] ?></td>
                        <td><?= $row['sgpt'] ?></td>
                        <td><?= $row['sgot'] ?></td>
                        <td><?= $row['result'] ?></td>
                        <td><?= $row['kmeans'] ?></td>
                        <td><?= $row['bayes'] ?></td>
                        <td><?php if ($row['result'] == 1 and $row['kmeans'] == 1) {
                                echo "TP";
                            } elseif ($row['result'] == 0 and $row['kmeans'] == 0) {
                                echo "TN";
                            } elseif ($row['result'] == 0 and $row['kmeans'] == 1) {
                                echo "FP";
                            } elseif ($row['result'] == 1 and $row['kmeans'] == 0) {
                                echo "FN";
                            }
                            ?></td>
                        <td><?php if ($row['result'] == 1 and $row['bayes'] == 1) {
                                echo "TP";
                            } elseif ($row['result'] == 0 and $row['bayes'] == 0) {
                                echo "TN";
                            } elseif ($row['result'] == 0 and $row['bayes'] == 1) {
                                echo "FP";
                            } elseif ($row['result'] == 1 and $row['bayes'] == 0) {
                                echo "FN";
                            }
                            ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

    </div>
</body>

</html>