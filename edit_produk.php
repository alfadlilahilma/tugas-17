<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Produk</h2>
        <?php
        include 'koneksi.php';

        $id = $_GET['id'];
        $query = "SELECT * FROM produk WHERE id = $id";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        ?>
        <form method="post" action="update_produk.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="<?= $row['nama_produk'] ?>">
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="text" name="harga" class="form-control" value="<?= $row['harga'] ?>">
            </div>
            <div class="form-group">
                <label>Stok</label>
                <input type="text" name="stok" class="form-control" value="<?= $row['stok'] ?>">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
