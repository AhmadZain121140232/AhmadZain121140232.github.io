<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>UAS</title>
</head>

<body>
    <div class="container">
        <section>
            <h1>Update Data</h1>
            <?php
            include 'database.php';

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nim'])) {
                $nim = $_GET['nim'];
                $db = new Data("localhost", "root", "", "pemweb");
                $result = $db->getnim($nim);

                if ($result !== false && count($result) > 0) {
                    $data = $result[0];
                    ?>
                    <form method="post">
                        <div class="ex">
                            <label for="nama">Nama:</label>
                            <input type="text" value="<?= $data["nama"] ?>" name="nama" required>
                        </div>

                        <br>

                        <div class="ex">
                            <label for="nim">nim:</label>
                            <input type="text" value="<?= $data["nim"] ?>" name="nim" required readonly>
                        </div>

                        <br>

                        <div class="ex">
                            <label for="no_telepon">no_telepon</label>
                            <input type="text" value="<?= $data["no_telepon"] ?>" name="no_telepon" required>
                        </div>

                        <br>

                        <div class="ex">
                            <label>Jenis Kelamin:</label>
                            <input type="radio" id="male" name="kelamin" value="Laki-laki" <?= ($data["kelamin"] == "Laki-laki") ? "checked" : "" ?>>
                            <label for="Laki-laki">Laki-laki</label>
                            <input type="radio" id="female" name="kelamin" value="Perempuan" <?= ($data["kelamin"] == "Perempuan") ? "checked" : "" ?>>
                            <label for="Perempuan">Perempuan</label>
                        </div>

                        <br>
                        <div class="btn">
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                    <?php
                }
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
                $no_telepon = isset($_POST['no_telepon']) ? $_POST['no_telepon'] : '';
                $kelamin = isset($_POST['kelamin']) ? $_POST['kelamin'] : '';

                $db = new Data("localhost", "root", "", "pemweb");

                $saveResult = $db->updateBynim($nim, $name, $no_telepon, $kelamin);

                if ($saveResult) {
                    echo '<script>alert("Data berhasil diupdate."); window.location.href = "index.php";</script>';
                    exit();
                } else {
                    echo "Update gagal";
                }
                $db->closeConnection();
            }
            ?>
        </section>
    </div>
</body>

</html>