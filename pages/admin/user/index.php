<?php 
require __DIR__ . "../../../../controllers/produk.php";

// cek apakah ada request cari
if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $users = cariUsers($keyword);
} else {
    $users = getUser();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP MYSQL</title>
    <link rel="stylesheet" href="../../../assets/css/dashboardstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- HEADER ADMIN -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <span class="navbar-brand mb-0 h1">
            <img src="https://img.icons8.com/color/48/000000/php.png" width="30" height="30" class="d-inline-block align-top" alt="">
            ADMIN CRUD DASHBOARD
        </span>
    </nav>

    <div class="wrapper">
        <!-- SIDEBAR -->
        <?php include("../includes/sidebar.php") ?>
    
        <!-- MAIN CONTENT -->
        <main class="content">

            <section class="judul">
                <h1>CRUD Products Dashboard</h1>
            </section>

            <section class="search-add">
                <button type="button" class="btn btn-primary"><i class="bi bi-plus-square"></i> Add Product</button>
                <form class="form-inline d-flex" action="" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" name="keyword" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" name="cari" type="submit">Search</button>
                </form>
            </section>

            <section class="data-sec">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <th scope="row"><?= $user["id"] ?></th>
                            <td><?= $user["email"] ?></td>
                            <td><?= $user["username"] ?></td>
                            <td><?= $user["role"] ?></td>
                            <td><?= $user["created_at"] ?></td>
                            <td>
                                <a type="button" class="btn btn-danger" href="../../../controllers/CRUD/hapus.php?id_user=<?= $user['id']?>" onclick="return confirm('Yakin ingin menghapus user?')" >Delete <i class="bi bi-trash-fill"></i></a>
                                <a type="button" class="btn btn-warning">Edit <i class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
            </section>  
        </main>
    </div>


</body>
</html>
