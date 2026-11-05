<?php
  $page = $page ?? ""; 
?>
/* each page sets $page before including, e.g. $page = "jobs"; */
<!-- ---------  Navigation Row  ----------- -->
<nav class="nav-row">
    <a href="index.html" class="logo-link"><img src="Media/Navigation_bar/logo-ngan.svg" alt="Meowdia Agency"
            class="logo"></a>

    <details class="main-nav norm_text" open>

        <summary><img src="Media/Navigation_bar/Paw.svg" alt="navigation bar button" class="icon"></summary>

        <div>
            <a href="index.php" <?php if ($page == "home") echo 'class = "active" aria-current="page"'; else echo 'class="cyan"'; ?> style="padding-left: 0.2em;">Home</a>
            <a href="jobs.html" <?php if ($page == "jobs") echo 'class = "active" aria-current="page"'; else echo 'class="cyan"'; ?>>Jobs</a>
            <a href="apply.php" <?php if ($page == "apply") echo 'class = "active" aria-current="page"'; else echo 'class="cyan"'; ?>>Apply</a>
            <a href="about.php" <?php if ($page == "about") echo 'class="active" aria-current="page"'; else echo 'class="cyan"'; ?>>About</a>
            <form class="nav-search" action="#" role="search">
                <input type="search" class="norm-text cyan" id="search-box" name="search" placeholder="Search">
                <button type="submit">
                    <img src="Media/Navigation_bar/maginifying-glass-navbar.svg" alt="Search button">
                </button>
            </form>
        </div>
    </details>
</nav>