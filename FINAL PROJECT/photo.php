<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Photo Gallery</title>
  <link rel="stylesheet" href="dashstyle.css">
  <style>
    .content {
      text-align: center;
      padding: 20px;
    }
    h2 {
      font-size: 28px;
      color: #007B8F;
      margin-bottom: 15px;
    }

    /* Upload Form */
    .upload-container {
      background: #E3F2FD;
      padding: 15px;
      border-radius: 10px;
      display: inline-block;
      margin-bottom: 20px;
    }
    .upload-container input[type="file"] {
      padding: 10px;
      border: 2px dashed #007B8F;
      border-radius: 8px;
      background: white;
      cursor: pointer;
      transition: 0.3s;
    }
    .upload-container input[type="file"]:hover {
      background: #f0f8ff;
    }

    /* Upload Button */
    .Table_btn {
      padding: 8px 15px;
      background: #007B8F;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      color: #fff;
      cursor: pointer;
      transition: 0.3s;
    }
    .Table_btn:hover {
      background: #0B87A6;
    }

    /* Gallery Grid */
    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 15px;
      padding: 20px;
      justify-content: center;
    }
    .alb {
      overflow: hidden;
      border-radius: 10px;
      transition: 0.3s;
    }
    .alb img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
      transition: transform 0.3s ease-in-out;
    }
    .alb:hover img {
      transform: scale(1.05);
    }

    /* Responsive */
    @media screen and (max-width: 768px) {
      .gallery {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      }
    }
  </style>
</head>
<body style="background:#d8bfd8">



<!-- Header -->
<header style="background:#121212">
  <label for="check">
    <i class="fas fa-bars" id="sidebar_btn"></i>
  </label>
  <div class="left_area">
    <h1>Beverly Hills</h1>
  </div>
  <div class="right_area">
    <a href="logout.php" class="logout_btn">Logout</a>
  </div>
</header>
<!-- End Header -->

<!-- Sidebar -->
<div class="sidebar" style="background:#121212">
  <center>
    <img src="profile.jpg" class="profile_image" alt="">
    <h4><?php echo $_SESSION['username']; ?></h4>
  </center>
  <a href="Welcome.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
  <a href="noticebrd.php"><i class="fas fa-bullhorn"></i><span>Notice Board</span></a>
  <a href="complaint.php"><i class="fas fa-envelope-open-text"></i><span>Register Complaint</span></a>
  <a href="payment.php"><i class="fas fa-file-invoice-dollar"></i><span>Maintenance Payment</span></a>
  <a href="photo.php" class="active"><i class="fas fa-camera-retro"></i><span>Photo Gallery</span></a>
</div>
<!-- End Sidebar -->

<!-- Content -->
<div class="content">
  <h2>Upload Your Anonymous Photos</h2>

  <?php if (isset($_GET['error'])): ?>
    <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
  <?php endif; ?>

  <div class="upload-container">
    <form action="picadd.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="my_image" required>
      <input type="submit" class="Table_btn" name="upload" value="Upload">
    </form>
  </div>

  <div class="gallery">
    <?php 
      $sql = "SELECT * FROM images ORDER BY id DESC";
      $res = pg_query($conn, $sql);
      
      if (pg_num_rows($res) > 0) {
        while ($images = pg_fetch_assoc($res)) {
    ?>
          <div class="alb">
            <img src="Images/<?php echo htmlspecialchars($images['image_url']); ?>" alt="Uploaded Image">
          </div>
    <?php 
        }
      } else {
          echo "<p>No images found.</p>";
      }
    ?>
  </div>
</div>
<!-- End Content -->

</body>
</html>
