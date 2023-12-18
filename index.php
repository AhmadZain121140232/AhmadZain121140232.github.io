<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>121140232</title>
</head>

<body>
    <div class="container">
        <section>
            <h1>Form Input</h1>
            <form method="post">
                <div class="ex">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>

                <br>

                <div class="ex">
                    <label for="nim">Nim:</label>
                    <input type="text" id="nim" name="nim" required>
                </div>

                <br>

                <div class="ex">
                    <label for="no_telepon">No Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" required>
                </div>

                <br>

                <div class="ex">
                    <label>Kelamin:</label>
                    <input type="radio" id="Pria" name="kelamin" value="Pria">
                    <label for="Pria">Pria</label>
                    <input type="radio" id="Wanita" name="kelamin" value="Wanita">
                    <label for="Wanita">Wanita</label>
                </div>

                <br>
                <div class="btn">
                    <input class="button" type="submit" value="Submit">
                </div>
            </form>

        </section>
    </div>

    <!-- <section class="table" id="view">
        <table id="dataTable">
        </table>
    </section> -->

    <section class="db">
        <h1>Table Database</h1>
        <table id="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>No Telepon</th>
                    <th>Kelamin</th>
                    <th>Ubah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "database.php";

                $db = new Data("localhost", "root", "", "pemweb");

                $list = $db->view();

                foreach ($list as $row):
                    ?>
                    <tr>
                        <td>
                            <?= $row['nama'] ?>
                        </td>
                        <td>
                            <?= $row['nim'] ?>
                        </td>
                        <td>
                            <?= $row['no_telepon'] ?>
                        </td>
                        <td>
                            <?= $row['kelamin'] ?>
                        </td>
                        <td>
                            <a href="edit.php?nim=<?= $row['nim'] ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <section class="output">
        <h2>Data</h2>
        <?php

        if (isset($_SESSION['data'])) {
            echo "Nama: " . $_SESSION['data']['nama'] . "<br>";
            echo "NIM: " . $_SESSION['data']['nim'] . "<br>";
            echo "No Telepon: " . $_SESSION['data']['no_telepon'] . "<br>";
            echo "Kelamin: " . $_SESSION['data']['kelamin'] . "<br>";
        } else {
            echo "Data not found";
        }
        ?>
    </section>

    <script src="script.js"></script>
    <script src="cookie.js"></script>
</body>

</html>