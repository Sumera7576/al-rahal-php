<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) { header("Location: admin-dashboard.php"); exit(); }
$id = (int)$_GET['id'];
$car = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM cars WHERE id = $id"));

if (isset($_POST['update_car'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = (int)$_POST['price'];
        $sql = "UPDATE cars SET name='$name', price='$price' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin-dashboard.php?tab=fleet&msg=updated");
    }
}
?>

<body class="bg-[#050810] text-white p-10">
    <h2 class="text-2xl font-bold mb-6">Edit <span class="text-blue-500"><?php echo $car['name']; ?></span></h2>
    <form method="POST" class="bg-white/5 p-8 rounded-3xl border border-white/10 max-w-2xl">
        <input type="text" name="name" value="<?php echo $car['name']; ?>" class="w-full bg-black/40 p-4 rounded-xl mb-4 border border-white/10">
        <input type="number" name="price" value="<?php echo $car['price']; ?>" class="w-full bg-black/40 p-4 rounded-xl mb-6 border border-white/10">
        <button type="submit" name="update_car" class="w-full bg-blue-600 py-4 rounded-xl font-bold uppercase">Update Details</button>
    </form>
</body>