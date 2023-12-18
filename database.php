<?php

class Data
{
    private $conn;

    public function __construct($host, $usernama, $password, $database)
    {
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$database", $usernama, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function post($nama, $nim, $kelamin, $no_telepon)
    {
        try {
            $sql = "INSERT INTO data(nama, nim, kelamin, no_telepon) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $nama, PDO::PARAM_STR);
            $stmt->bindParam(2, $nim, PDO::PARAM_INT);
            $stmt->bindParam(3, $kelamin, PDO::PARAM_STR);
            $stmt->bindParam(4, $no_telepon, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function updateBynim($nim, $newnama, $newkelamin, $newno_telepon)
    {
        try {
            $sql = "UPDATE data SET nama = :newnama, kelamin = :newkelamin, no_telepon = :newno_telepon WHERE nim = :nim";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':newnama', $newnama, PDO::PARAM_STR);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_INT);
            $stmt->bindParam(':newno_telepon', $newno_telepon, PDO::PARAM_INT);
            $stmt->bindParam(':newkelamin', $newkelamin, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error updating data: " . $e->getMessage());
        }
    }


    public function getnim($nim)
    {
        try {
            $sql = "SELECT * FROM data WHERE nim = ?";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $nim, PDO::PARAM_INT);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function view()
    {
        $sql = "SELECT nama, nim, no_telepon, kelamin FROM data";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }


    public function closeConnection()
    {
        $this->conn = null;
    }
}

?>