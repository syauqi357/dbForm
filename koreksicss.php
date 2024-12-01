<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modal Form</title>
  <link rel="stylesheet" href="MainStyle.css">
</head>

<body>
  <?php

  include "dua.php";

  $nim = $_GET['nim'];
  $nama = $_GET['nama'];
  $alamat = $_GET['alamat'];
  $jenis_kelamin = $_GET['jenis_kelamin'];

  ?>
  <div class="containMid">


    <form method="post" action="koreksiupdate.php" class="formMain">
      <h1>
        Edit data
      </h1>
      <p>
        edit data di sini!
      </p>
      <div class="inputBoxCh">

        <?php echo "Nim : <input type='text'  name='nim' readonly value='" . $nim . "'>"; ?>
      </div>
      <div class="inputBoxCh">

        <?php echo "Nama : <input type='text' name='nama' value='" . $nama . "'>"; ?>
      </div>
      <div class="inputBoxCh">

        <?php echo "Alamat : <input type='text' name='alamat' value='" . $alamat . "'>"; ?>
      </div>
      <div class="inputBoxCh">

        <?php echo "Jenis Kelamin : <input type='text' placeholder='P / L' maxlength='1' name='jenis_kelamin' value='" . $jenis_kelamin . "'>"; ?>
      </div>
      <div class="disFlexEdit">

        <button type="submit" value="Update" class="buttonStylingEditData">simpan data</button>
        <a href="panel.php">Kembali</a>
      </div>
    </form>
  </div>




</body>

</html>