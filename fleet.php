<?php
if (!defined('NAVBAR_LOADED')) {
    include_once 'header.php';
    define('NAVBAR_LOADED', true);
}
?>
<?php
include_once 'db.php';

$activeCategory = isset($_GET['category']) ? $_GET['category'] : 'All';
$searchLocation = isset($_GET['location']) ? mysqli_real_escape_string($conn, $_GET['location']) : '';

$sql = "SELECT * FROM cars WHERE 1=1";
if ($activeCategory !== 'All') {
    $safeCat = mysqli_real_escape_string($conn, $activeCategory);
    $sql .= " AND category = '$safeCat'";
}
if (!empty($searchLocation)) {
    $sql .= " AND location LIKE '%$searchLocation%'";
}

$result = mysqli_query($conn, $sql);
?>

<style>
    .fleet-wrapper { 
        position: relative;
        padding: 100px 0; 
        font-family: 'Inter', sans-serif;
        background: linear-gradient(rgba(5, 8, 16, 0.85), rgba(5, 8, 16, 0.85)), 
         url('https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?q=80&w=2070&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 5; }
    .fleet-header { text-align: center; margin-bottom: 60px; }
    .badge-top { color: #fff; font-weight: bold; font-size: 11px; letter-spacing: 3px; text-transform: uppercase; background: rgba(59, 130, 246, 0.5); padding: 8px 20px; border-radius: 50px; backdrop-filter: blur(5px); }
    .fleet-title { font-size: 48px; font-weight: 900; color: #ffffff; margin-top: 25px; text-shadow: 0 4px 10px rgba(0,0,0,0.3); }
    .blue-gradient { color: #60a5fa; }
    .filter-nav { display: flex; justify-content: center; gap: 15px; margin-bottom: 60px; flex-wrap: wrap; }
    .filter-btn { padding: 12px 28px; border-radius: 50px; border: 1px solid rgba(255, 255, 255, 0.2); background: rgba(255, 255, 255, 0.1); color: #fff; font-weight: 600; text-decoration: none; transition: 0.4s; backdrop-filter: blur(10px); }
    .filter-btn.active { background: #2563eb; border-color: #2563eb; box-shadow: 0 10px 20px rgba(37, 99, 235, 0.4); }
    .fleet-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 35px; }
    .car-card { background: rgba(255, 255, 255, 0.98); border-radius: 30px; overflow: hidden; transition: 0.5s; display: flex; flex-direction: column; box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
    .car-card:hover { transform: translateY(-12px); box-shadow: 0 30px 60px rgba(0,0,0,0.4); }
    .img-container { height: 260px; width: 100%; position: relative; overflow: hidden; }
    .img-container img { width: 100%; height: 100%; object-fit: cover; transition: 0.8s; }
    .car-card:hover .img-container img { transform: scale(1.1); }
    .cat-badge { position: absolute; top: 20px; left: 20px; background: #2563eb; color: white; padding: 6px 16px; border-radius: 12px; font-size: 10px; font-weight: 800; text-transform: uppercase; }
    .card-content { padding: 30px; flex-grow: 1; display: flex; flex-direction: column; }
    .car-name { font-size: 22px; font-weight: 800; color: #111827; margin: 0; }
    .car-price { color: #2563eb; font-size: 26px; font-weight: 900; }
    
    .stats-row { display: flex; justify-content: space-between; margin: 25px 0; border-top: 1px solid #eee; padding-top: 20px; color: #6b7280; font-size: 13px; }
    
    .book-btn { background: #111827; color: #fff; width: 100%; padding: 18px; border-radius: 18px; font-weight: 800; text-align: center; text-decoration: none; transition: 0.3s; margin-top: auto; }
    .book-btn:hover { background: #2563eb; box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3); }

    .no-results { text-align: center; grid-column: 1 / -1; padding: 100px; color: #fff; }
</style>
<section class="fleet-wrapper" id="fleet">
    <div class="container">
        <div class="fleet-header">
            <span class="badge-top">Our Collection</span>
            <h2 class="fleet-title">Choose Your <span class="blue-gradient">Perfect Drive</span></h2>
            <?php if(!empty($searchLocation)): ?>
                <p style="margin-top: 15px; color: #4b5563;">Available cars in: <span style="color: #2563eb; font-weight: bold;"><?php echo htmlspecialchars($searchLocation); ?></span></p>
            <?php endif; ?>
        </div>

        <div class="filter-nav">
            <?php 
            $categories = ["All", "Sports", "SUV", "Luxury", "Economical"];
            foreach($categories as $cat): 
                $isActive = ($activeCategory == $cat);
                $queryStr = "category=" . $cat;
                if(!empty($searchLocation)) { $queryStr .= "&location=" . urlencode($searchLocation); }
            ?>
                <a href="index.php?<?php echo $queryStr; ?>#fleet" class="filter-btn <?php echo $isActive ? 'active' : ''; ?>">
                    <?php echo $cat; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="fleet-grid">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <?php while($car = mysqli_fetch_assoc($result)): ?>
                    <div class="car-card">
                        <div class="img-container">
                            <img src="<?php echo (strpos($car['image'], 'http') !== false) ? $car['image'] : 'assets/'.$car['image']; ?>" alt="">
                            <div class="cat-badge"><?php echo $car['category']; ?></div>
                        </div>
                        <div class="card-content">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <h3 class="car-name"><?php echo $car['name']; ?></h3>
                                <div class="car-price"><?php echo $car['price']; ?><span style="font-size: 10px; color: #9ca3af; margin-left: 4px;">AED</span></div>
                            </div>
                            
                            <div class="stats-row">
                                <span>⚡ <?php echo $car['speed']; ?></span>
                                <span>⚙️ <?php echo $car['transmission']; ?></span>
                                <span>👥 <?php echo $car['seats']; ?> Seats</span>
                            </div>

                            <div style="margin-bottom: 15px; font-size: 11px; color: #6b7280;">
                                📍 <?php echo $car['location']; ?>
                            </div>

                            <a href="booking.php?id=<?php echo $car['id']; ?>" class="book-btn">Book This Car</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-results">
                    <p>Sorry, no cars found matching your criteria.</p>
                    <a href="index.php#fleet" style="color: #2563eb; font-weight: bold;">Show all cars</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
if (basename($_SERVER['PHP_SELF']) == 'fleet.php') {
    include_once 'footer.php';
}
?>
