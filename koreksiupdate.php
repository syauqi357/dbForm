<?php

include "dua.php";
$nim = $_REQUEST['nim'];
$nama = $_REQUEST['nama'];
$alm = $_REQUEST['alamat'];
$jk = $_REQUEST['jenis_kelamin'];
$conn = mysqli_connect($host, $user, $pass, $db);
$mysqli = "UPDATE mhs SET nama='" . $nama . "',alamat='" . $alm . "',jenis_kelamin='" . $jk . "' WHERE nim='$nim'";
$result = mysqli_query($conn, $mysqli);
$update_message = "Update Berhasil";
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        .button {
            background-color: green;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
        }

        .button:hover {
            background-color: darkgreen;
        }
    </style>
</head>

<body>

    <div class="card">
        <h3><?php echo $update_message; ?></h3>
        <a href="panel.php" class="button">Lihat</a>
    </div>

</body>

</html>