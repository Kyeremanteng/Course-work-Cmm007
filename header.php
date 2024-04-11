<?php
    require_once 'functions/config.php';
    $conn->close(); 
    if (!isset($_SESSION)) {
        session_start();
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Aj Cuisine</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="assets/logo.jpg" alt="" width="120" height="120" class="d-inline-block align-text-center">
                AJ's Cuisine
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="about.php">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="recipe.php">Recipes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="contact.php">Contact</a>
        </li>
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link active" href="admin.php">Admin Panel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="chef.php">Chef Dashboard</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link active" href="chef.php">Login</a>
            </li>
        <?php endif; ?>

    </ul>
</div>

    </nav>
    <?php if (isset($_SESSION['user_name'])): ?>
    <nav class="navbar justify-content-end align-items-center"
        style="background-color: #e3f2fd; padding-right: 50px;">
        <div class="text-end">
            Welcome, <?= htmlspecialchars($_SESSION['user_name']); ?>!
            <a href="functions/logout.php">Logout</a>
        </div>
    </nav>
    <?php endif; ?>
</header>
