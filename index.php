<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Data Produk</h2>
        <a href="tambah_produk.php" class="btn btn-primary">Tambah Produk</a>
        <br><br>
        <form method="post" action="index.php">
            <input type="text" name="search" placeholder="Cari Produk">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';

                $search = isset($_POST['search']) ? $_POST['search'] : '';

                // Menampilkan data dengan paginasi
                $results_per_page = 10;
                $query = "SELECT * FROM produk 
                          WHERE nama_produk LIKE '%$search%'
                          LIMIT 10";
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nama_produk'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>" . $row['stok'] . "</td>";
                    echo "<td>
                        <a href='edit_produk.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a>
                        <a href='hapus_produk.php?id=" . $row['id'] . "' class='btn btn-danger'>Hapus</a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
