<?php
include('./backend/session_check.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="icon" href="assets/website icon.png" type="image/png" />
    <title>Dashboard</title>
</head>

<body>
    <div id="video-overlay">
        <video id="intro-video" autoplay muted>
            <source src="assets\aelluminate intro.mp4" type="video/mp4" />
            Your browser does not support the video tag.
        </video>
    </div>

    <div id="main-content" class="app">
        <aside class="sidebar">
            <?php include './components/sidebar.php' ?>
        </aside>
        <section>
            <div class="container">
                <header>
                    <?php include './components/header.php' ?>
                </header>
                <!-- Dashboard -->
                <div class="dashboard">
                    <h2>Dashboard</h2>
                    <!-- User Overview -->
                    <div class="user-overview-box">
                        <h4>User Overview</h4>
                        <hr />
                        <ul>
                            <li>
                                <span>
                                    <div class="total-users"></div>
                                </span>Total Users
                            </li>
                            <hr />
                            <li><span>
                                    <div class="total-managers"></div>
                                </span>Managers</li>
                            <hr />
                            <li><span>
                                    <div class="total-alumni"></div>
                                </span>Alumni</li>
                        </ul>
                    </div>
                    <!-- Post Activity -->
                    <div class="charts">
                        <h5>Post Activity</h5>
                        <canvas id="postsChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="./scripts/index.js" type="module"></script>
    <script src="./scripts/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>