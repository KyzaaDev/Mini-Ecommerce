<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
</head>
<body>
    <?php require("../controllers/produk.php");?>
    <?php 
        $id = (int) $_GET["id"];
        $detail = getData($id);?>
    <h1><?= htmlspecialchars($detail["nama_product"]);?></h1>
    
</body>
</html>