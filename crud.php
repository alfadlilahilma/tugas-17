<?php
include 'koneksi.php';

// Fungsi untuk mencari produk
function cari_produk($search, $offset, $limit) {
    global $conn;
    $search = $conn->real_escape_string($search);
    $query = "SELECT * FROM produk 
              WHERE nama_produk LIKE '%$search%'
              LIMIT $limit OFFSET $offset";
    $result = $conn->query($query);
    return $result;
}

// Fungsi untuk menghitung jumlah hasil pencarian
function hitung_hasil_cari($search) {
    global $conn;
    $search = $conn->real_escape_string($search);
    $query = "SELECT COUNT(*) as total FROM produk WHERE nama_produk LIKE '%$search'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['total'];
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$search = isset($_GET['search']) ? $_GET['search'] : '';

$total_results = hitung_hasil_cari($search);
$total_pages = ceil($total_results / $limit);
$offset = ($page - 1) * $limit;

$result = cari_produk($search, $offset, $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Produk</title>
</head>
<body>
    <h1>CRUD Produk</h1>
    <form action="index.php" method="GET">
        <input type="text" name="search" placeholder="Cari produk...">
        <button type="submit">Cari</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Harga</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_produk'] . "</td>";
                echo "<td>" . $row['nama_produk'] . "</td>";
                echo "<td>" . $row['harga'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada hasil ditemukan.</td></tr>";
        }
        ?>
    </table>

    <div class="pagination">
        <?php
        for ($page = 1; $page <= $total_pages; $page++) {
            echo "<a href='index.php?search=$search&page=$page'>$page</a>";
        }
        ?>
    </div>
</body>
</html>
