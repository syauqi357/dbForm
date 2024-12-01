<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Paging with Search</title>
    <link rel="stylesheet" href="MainStyle.css">
</head>

<body>

    <!-- navbar -->

    <nav id="navbar">
        <div class="navbar-overlay" onclick="toggleMenuOpen()"></div>

        <button type="button" class="navbar-burger menu--control" onclick="toggleMenuOpen()">
            <span class="material-icons">menu</span>
        </button>
        <h1 class="navbar-title"> DATA MAHASISWA STI A SMT 5 </h1>
        <nav class="navbar-menu">
            <ul>
                <li>
                    <a href="cetakPrint.php" class="buttonStyling bigger"> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                            <path d="M725.52-685.52H234.64v-161.34h490.88v161.34Zm2.76 212.05q15.02 0 25.69-10.63 10.68-10.62 10.68-25.65 0-14.95-10.63-25.74t-25.74-10.79q-15.02 0-25.73 10.79t-10.71 25.74q0 14.94 10.71 25.61t25.73 10.67Zm-78.67 289.2v-165.95H310.39v165.95h339.22Zm75.91 74.39H234.64v-175.21H73.3v-249.58q0-49.6 33.79-83.56t83.02-33.96h579.78q49.71 0 83.34 33.96t33.63 83.56v249.58H725.52v175.21Z" />
                        </svg>
                        Cetak
                    </a>
                </li>
                <a href="#">
                    <button class="contr-action buttonStyling">this is button</button>
                </a>

            </ul>
        </nav>
    </nav>

    <!-- navbar -->

    <?php
    include "dua.php"; // Ensure your database connection is in this file.

    // Search logic
    $cari = isset($_GET['cari']) ? $_GET['cari'] : '';

    // Pagination setup
    $batas = 20; // Number of records per page
    $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
    $posisi = ($halaman > 1) ? ($halaman - 1) * $batas : 0;

    // Query with search and pagination
    $query = "SELECT * FROM mhs 
              WHERE nim LIKE '%$cari%' 
              OR nama LIKE '%$cari%' 
              OR alamat LIKE '%$cari%' 
              OR jenis_kelamin LIKE '%$cari%' 
              LIMIT $posisi, $batas";
    $tampil = mysqli_query($conn, $query);

    // Total data for pagination
    $query_total = "SELECT * FROM mhs 
                    WHERE nim LIKE '%$cari%' 
                    OR nama LIKE '%$cari%' 
                    OR alamat LIKE '%$cari%' 
                    OR jenis_kelamin LIKE '%$cari%'";
    $result_total = mysqli_query($conn, $query_total);
    $jmldata = mysqli_num_rows($result_total);
    $jmlhalaman = ceil($jmldata / $batas);
    ?>

    <!-- Search Form -->
    <div class="containerOut">
        <div class="boxinput">
            <form action="" method="get" class="DisFlex">
                <input type="text" name="cari" placeholder="Cari Data" value="<?php echo $cari; ?>" />
                <button value="cari" type="submit" class="buttonStylingSearch">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                        <path d="M782.87-98.52 526.91-354.48q-29.43 21.74-68.15 34.61Q420.04-307 375.48-307q-114.09 0-193.55-79.46-79.45-79.45-79.45-193.54 0-114.09 79.45-193.54Q261.39-853 375.48-853q114.09 0 193.54 79.46 79.46 79.45 79.46 193.54 0 45.13-12.87 83.28T601-429.7l256.52 257.09-74.65 74.09ZM375.48-413q69.91 0 118.45-48.54 48.55-48.55 48.55-118.46t-48.55-118.46Q445.39-747 375.48-747t-118.46 48.54Q208.48-649.91 208.48-580t48.54 118.46Q305.57-413 375.48-413Z" />
                    </svg>
                </button>
            </form>
        </div>


        <!-- Table Display -->
        <div class="blockerPost">

            <div class="addNewdata">
                <button id="openModalBtn" class="buttonStyling bigger">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                        <path d="M436.41-317.61h87.18v-118.8h118.56v-87.18H523.59v-118.56h-87.18v118.56h-118.8v87.18h118.8v118.8ZM480-71.87q-17.91 0-34.45-6.46-16.53-6.45-29.44-19.89L99.74-415.35q-12.67-13.67-20.27-30.2-7.6-16.54-7.6-34.45 0-17.91 7.6-34.45 7.6-16.53 20.27-29.2l316.37-317.37q13.67-13.68 29.82-20.39 16.16-6.72 34.07-6.72t34.83 6.72q16.91 6.71 29.58 20.39l315.85 317.37q12.91 13.43 20.39 29.58 7.48 16.16 7.48 34.07t-7.1 34.45q-7.1 16.53-20.77 30.2L544.41-98.22q-12.67 12.68-29.58 19.51-16.92 6.84-34.83 6.84Z" />
                    </svg>
                    Tambah Data
                </button>
            </div>


            <form action="" method="post">
                <table border="1">
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (mysqli_num_rows($tampil) > 0) { ?>
                        <?php
                        $no = $posisi + 1;
                        while ($data = mysqli_fetch_array($tampil)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data["nim"]; ?></td>
                                <td><?php echo $data["nama"]; ?></td>
                                <td><?php echo $data["alamat"]; ?></td>
                                <td><?php echo $data["jenis_kelamin"]; ?></td>
                                <td class='recorrDel'>
                                    <a href="delete.php?nim=<?php echo $data['nim']; ?>" class="buttonStyling del">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            height="24px"
                                            viewBox="0 -960 960 960"
                                            width="24px"
                                            fill="#5f6368">
                                            <path
                                                d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                        </svg>

                                    </a>
                                    <a href="koreksicss.php?nim=<?php echo $data['nim']; ?>&nama=<?php echo $data['nama']; ?>&alamat=<?php echo $data['alamat']; ?>&jenis_kelamin=<?php echo $data['jenis_kelamin']; ?>" class="buttonStyling corr">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            height="24px"
                                            viewBox="0 -960 960 960"
                                            width="24px"
                                            fill="#5f6368">
                                            <path
                                                d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                                        </svg>

                                    </a>
                                </td>

                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6">Data tidak ditemukan.</td>
                        </tr>
                    <?php } ?>
                </table>
            </form>
        </div>

    </div>


    <!-- Pagination Links -->
    <div class="blockOuter">
        <?php
        echo "<p>Halaman:</p>";
        for ($i = 1; $i <= $jmlhalaman; $i++) {
            if ($i != $halaman) {
                echo "<a href=\"?halaman=$i&cari=$cari\" class='buttonStyling'>$i</a>";
            } else {
                echo "<b>$i</b>";
            }
        }
        echo "<p>Total Mahasiswa: <b>$jmldata</b> orang</p>";
        ?>
    </div>

    <!-- add data -->

    <div id="modal">
        <form method="post" action="tiga.php" class="formMain">
            <div class="backButton">
                <button type="button" onclick="closeModal()" class="buttonStylingBackbtn">Kembali</button>
                <div class="closeBtn">
                    <button type="button" onclick="closeModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                            <path d="M333.06-274.87 480-421.81l146.94 146.94 58.19-58.19L538.19-480l146.94-146.94-58.19-58.19L480-538.19 333.06-685.13l-58.19 58.19L421.81-480 274.87-333.06l58.19 58.19ZM479.72-56.75q-87.09 0-164.41-33.34-77.31-33.33-134.6-90.62Q123.42-238 90.09-315.38q-33.34-77.38-33.34-164.6 0-87.9 33.4-165.19 33.39-77.3 90.88-134.83 57.49-57.54 134.6-90.47 77.12-32.94 164.04-32.94 87.95 0 165.46 32.93 77.52 32.92 134.9 90.44 57.38 57.53 90.38 134.95 33 77.42 33 165.48 0 87.39-32.94 164.25-32.93 76.87-90.47 134.34-57.53 57.48-134.9 90.87-77.37 33.4-165.38 33.4Z" />
                        </svg>
                    </button>
                </div>
            </div>

            <h1>Masukkan Data</h1>
            <div class="inputBoxCh">Nim : <input type="text" name="nim" /></div>
            <div class="inputBoxCh">Nama : <input type="text" name="nama" /></div>
            <div class="inputBoxCh">Alamat : <input type="text" name="alamat" /></div>
            <div class="inputBoxCh">
                Jenis Kelamin : <input type="text" placeholder="P / L" maxlength="1" name="jenis_kelamin" />
            </div>

            <div class="savenSee">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                        <path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160ZM480-240q50 0 85-35t35-85q0-50-35..." />
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>


    <!-- add data -->
    
    
    <script>

    </script>


    <script>
        const toggleMenuOpen = () => document.body.classList.toggle("open");

        const nav = document.querySelector("#navbar");

        const onScroll = (event) => {
            const scrollPosition = event.target.scrollingElement.scrollTop;
            if (scrollPosition > 10) {
                if (!nav.classList.contains("scrolled-down")) {
                    nav.classList.add("scrolled-down");
                }
            } else {
                if (nav.classList.contains("scrolled-down")) {
                    nav.classList.remove("scrolled-down");
                }
            }
        };

        document.addEventListener("scroll", onScroll);

        const modal = document.getElementById("modal");
        const openModalBtn = document.getElementById("openModalBtn");

        const openModal = () => {
            modal.style.display = "flex";
        };

        const closeModal = () => {
            modal.style.display = "none";
        };

        openModalBtn.addEventListener("click", openModal);

        const modaledit = document.getElementById("modaledit");

        const openModaledit = () => {
            modal.style.display = "flex";
        };

        const closeModaledit = () => {
            modal.style.display = "none";
        };
    </script>

</body>

</html>