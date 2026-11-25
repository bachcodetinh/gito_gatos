<?php $page = "jobs"; 
  require_once "settings.php";
  mysqli_report(MYSQLI_REPORT_OFF);
  $conn = mysqli_connect($host, $user, $pwd, $sql_db);
?>
<!--
Filename: jobs.html
Author: Yen Ngan Bui
Created: October 8, 2026
Last modified: November 25, 2026
Description: jobs page, converted from jobs.html to PHP (Project Part 2)
AI acknowledgement: Yen Ngan used Claude and Gemini to check the page against the assignment requirements.
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Yen Ngan Bui">
  <meta name="description" content="This page lists available job positions: Front-End developer and UI Designer at Meowdia Agency">
  <title>Jobs - Meowdia Agency</title>
  <link rel="icon" type="image/svg+xml" href="Media/Navigation_bar/logo-ngan.svg">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="page_css/Jobs/job-style.css">
  <style>
   body {
            background: repeating-linear-gradient(35deg,
                    #000000, var(--background-color),
                    #000000, var(--background-color),
                    #000000, var(--background-color),
                    #000000);
        }
    a {
            z-index: 9999;
        }
  </style>
</head>

<body>
<a id="top"></a>
<!--Navigation Row-->
<?php include "common_html/nav.inc"; ?>
<header class="hero">
    <div class="hero-text">
      <!-- "OUR TEAM" is a link to the About page -->
      <h1>JOIN <a href="about.php" class="highlight">OUR TEAM</a></h1>
      <!-- Inline CSS -->
      <p class="hero-sub">Are you the <span style="color: var(--secondary-color);">purr-fect cat</span><br>we're missing?</p>
    </div>
    <img src="Media/Jobs/catjobs1.png" alt="Meowdia cat looking for new team members" class="hero-cat">
  </header>
<div class="yel_bar_section"></div>
  <!-- MAIN CONTENT -->
  <main class="jobs-layout">

    <!--  ASIDE: Benefits -->
    <aside class="benefits">
      <!-- "Benefits" open or close on small screens -->
      <input type="checkbox" id="benefits-switch" class="benefits-check">
      <h2><label for="benefits-switch" class="benefits-button">Benefits</label></h2>
      <ul class="benefits-list">
        <li>Flexible working hours.</li>
        <li>Open work environment, always encouraging innovative ideas.</li>
        <li>Providing modern equipment (MacBook, external monitors) to support work to the fullest.</li>
        <li>Regular team building activities and skill development workshops.</li>
      </ul>
    </aside>

    <!-- Available positions -->
    <section class="positions" aria-labelledby="positions-heading">
      <h2 id="positions-heading" class="pill-heading">Available Positions</h2>

<?php
  if (!$conn) {
    echo "<p class='job-message'>Meow! Our cat chewed through the database cable. Try again later!</p>";
  } else {
    $sql = "SELECT * FROM jobs ORDER BY job_ref";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
      echo "<p class='job-message'>A cat walked across the keyboard and broke the query. Debugging meow...</p>";
    } elseif (mysqli_num_rows($result) == 0) {
      echo "<p class='job-message'>No positions open. We are simply too purr-fect to hire right now.</p>";
    } else {

      $fed = mysqli_fetch_assoc($result);
      $uid = mysqli_fetch_assoc($result);
?>
      <!-- Hidden radio buttons -->
      <input type="radio" name="job" id="tab-fed" class="tab-radio" checked>
      <input type="radio" name="job" id="tab-uid" class="tab-radio">

      <!-- Switch bar: clicking a label checks its radio button -->
      <div class="switch-bar">
        <label for="tab-fed"><?php echo htmlspecialchars($fed["title"]);?></label>
        <label for="tab-uid"><?php echo htmlspecialchars($uid["title"]);?></label>
        <span class="slider"></span>
      </div>

      <!-- JOB 1: Front-End Developer -->
      <article class="job" id="job-fed">
        <h3 class="job-title"><?php echo htmlspecialchars($fed["title"]);?></h3>
        <p class="job-desc"><?php echo htmlspecialchars($fed["description"]);?></p>

        <ul class="job-tags">
          <li>Ref code: <?php echo htmlspecialchars($fed["job_ref"]);?></li>
          <li><?php echo $fed["salary"];?> AUD/month</li>
          <li>Reports to: <?php echo htmlspecialchars($fed["reporting_to"]);?></li>
          <li><?php echo htmlspecialchars($fed["job_level"]);?></li>
        </ul>

        <section class="job-part">
          <h4 class="yellow-text">Key Responsibilities</h4>
          <ol>
             <?php
              //Responsibilities of FED01
              $sql = "SELECT responsibility FROM job_responsibilities WHERE job_ref = 'FED01' ORDER BY id";
              $list = mysqli_query($conn, $sql);
              if ($list) {
                while ($item = mysqli_fetch_assoc($list)) {
                  echo "<li>" . htmlspecialchars($item["responsibility"]) . "</li>";
                }
              }
            ?>
          </ol>
        </section>

        <section class="job-part">
          <h4>Essential <span class="yellow-text">Requirements</span></h4>
          <ul>
            <?php
              //Essential requirements of FED01
              $sql = "SELECT requirement FROM job_requirements WHERE job_ref = 'FED01' AND type = 'essential' ORDER BY id";
              $list = mysqli_query($conn, $sql);
              if ($list) {
                while ($item = mysqli_fetch_assoc($list)) {
                  echo "<li>" . htmlspecialchars($item["requirement"]) . "</li>";
                }
              }
            ?>
        </section>

        <section class="job-part">
          <h4>Preferred <span class="yellow-text">Requirements</span></h4>
          <ul>
             <?php
              //Preferable requirements of FED01
              $sql = "SELECT requirement FROM job_requirements WHERE job_ref = 'FED01' AND type = 'preferable' ORDER BY id";
              $list = mysqli_query($conn, $sql);
              if ($list) {
                while ($item = mysqli_fetch_assoc($list)) {
                  echo "<li>" . htmlspecialchars($item["requirement"]) . "</li>";
                }
              }
            ?>
          </ul>
        </section>

        <a href="apply.php" class="apply-button">Apply now</a>
      </article>

      <!-- JOB 2: UI Designer -->
      <article class="job" id="job-uid">
        <h3 class="job-title"><?php echo htmlspecialchars($uid["title"]);?></h3>
        <p class="job-desc"><?php echo htmlspecialchars($uid["description"]); ?></p>

        <ul class="job-tags">
          <li>Ref code: <?php echo htmlspecialchars($uid["job_ref"]);?></li>
          <li><?php echo $uid["salary"];?> AUD/month</li>
          <li>Reports to: <?php echo htmlspecialchars($uid["reporting_to"]);?></li>
          <li><?php echo htmlspecialchars($uid["job_level"]);?></li>
        </ul>

        <section class="job-part">
          <h4 class="yellow-text">Key Responsibilities</h4>
          <ol>
            <?php
              //Responsibilities of UID02
              $sql = "SELECT responsibility FROM job_responsibilities WHERE job_ref = 'UID02' ORDER BY id";
              $list = mysqli_query($conn, $sql);
              if ($list) {
                while ($item = mysqli_fetch_assoc($list)) {
                  echo "<li>" . htmlspecialchars($item["responsibility"]) . "</li>";
                }
              }
            ?>
          </ol>
        </section>

        <section class="job-part">
          <h4>Essential <span class="yellow-text">Requirements</span></h4>
          <ul>
            <?php
              //Essential requirements of UID02
              $sql = "SELECT requirement FROM job_requirements WHERE job_ref = 'UID02' AND type = 'essential' ORDER BY id";
              $list = mysqli_query($conn, $sql);
              if ($list) {
                while ($item = mysqli_fetch_assoc($list)) {
                  echo "<li>" . htmlspecialchars($item["requirement"]) . "</li>";
                }
              }
            ?>
          </ul>
        </section>

        <section class="job-part">
          <h4>Preferred <span class="yellow-text">Requirements</span></h4>
          <ul>
            <?php
              //Preferable requirements of UID02
              $sql = "SELECT requirement FROM job_requirements WHERE job_ref = 'UID02' AND type = 'preferable' ORDER BY id";
              $list = mysqli_query($conn, $sql);
              if ($list) {
                while ($item = mysqli_fetch_assoc($list)) {
                  echo "<li>" . htmlspecialchars($item["requirement"]) . "</li>";
                }
              }
            ?>
          </ul>
        </section>

        <a href="apply.php" class="apply-button">Apply now</a>
      </article>
<?php
    }
    mysqli_close($conn);
  }
?>
    </section>

  </main>

  <!--End Button Content-->
    <div id="end_button">
        <a class="button" href="index.php">Home</a>
        <a class="button" href="#top">Back to Top</a>
        <a class="button" href="about.php">About Us</a>
    </div>
 
    <!--Footer Content-->
    <?php include 'common_html/footer.inc' ?> 
</body>
</html>