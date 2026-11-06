<?php $page = "jobs"; ?>
<!--
Filename: jobs.html
Author: Yen Ngan Bui
Created: October 8, 2026
Last modified: November 6, 2026
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

      <!-- Hidden radio buttons -->
      <input type="radio" name="job" id="tab-fed" class="tab-radio" checked>
      <input type="radio" name="job" id="tab-uid" class="tab-radio">

      <!-- Switch bar: clicking a label checks its radio button -->
      <div class="switch-bar">
        <label for="tab-fed">Front-End Developer</label>
        <label for="tab-uid">UI Designer</label>
        <span class="slider"></span>
      </div>

      <!-- JOB 1: Front-End Developer -->
      <article class="job" id="job-fed">
        <h3 class="job-title">Front-End Developer</h3>
        <p class="job-desc">We are looking for a Front-End Developer to build interactive, responsive websites for our diverse client projects.</p>

        <ul class="job-tags">
          <li>Ref code: FED01</li>
          <li>3.500,0 AUD/month</li>
          <li>Reports to: Technical Lead</li>
          <li>Senior</li>
        </ul>

        <section class="job-part">
          <h4 class="yellow-text">Key Responsibilities</h4>
          <ol>
            <li>Develop user interface features using HTML5, CSS3 and JavaScript.</li>
            <li>Collaborate closely with the design team to translate graphic designs into actual web interfaces.</li>
            <li>Optimize websites to ensure fast loading times and the best possible user experience.</li>
          </ol>
        </section>

        <section class="job-part">
          <h4>Essential <span class="yellow-text">Requirements</span></h4>
          <ul>
            <li>5+ years of experience.</li>
            <li>Proficient in HTML, CSS, and pure JavaScript.</li>
            <li>Has practical experience with Responsive Web Design (works well on all devices).</li>
            <li>Strong problem-solving and teamwork skills.</li>
          </ul>
        </section>

        <section class="job-part">
          <h4>Preferred <span class="yellow-text">Requirements</span></h4>
          <ul>
            <li>Has basic knowledge of search engine optimization (SEO).</li>
            <li>Has experience using Git and GitHub for source code management.</li>
          </ul>
        </section>

        <a href="apply.php" class="apply-button">Apply now</a>
      </article>

      <!-- JOB 2: UI Designer -->
      <article class="job" id="job-uid">
        <h3 class="job-title">UI Designer</h3>
        <p class="job-desc">Join our creative team to design visually appealing, interactive, and intuitive interfaces for our web and digital products.</p>

        <ul class="job-tags">
          <li>Ref code: UID02</li>
          <li>3.200,0 AUD/month</li>
          <li>Reports to: Creative Director</li>
          <li>Senior</li>
        </ul>

        <section class="job-part">
          <h4 class="yellow-text">Key Responsibilities</h4>
          <ol>
            <li>Collaborate with UX designers and product teams to translate wireframes and user flows into high-fidelity visual designs.</li>
            <li>Create high-quality mockups, interactive prototypes, and maintain design systems/style guides for web projects.</li>
            <li>Design and refine visual interface components such as menus, tabs, icons, and widgets, ensuring visual consistency across all screens.</li>
          </ol>
        </section>

        <section class="job-part">
          <h4>Essential <span class="yellow-text">Requirements</span></h4>
          <ul>
            <li>5+ years of experience.</li>
            <li>Proven experience in UI design with a strong portfolio demonstrating web design, aesthetics, and visual skills.</li>
            <li>Proficient in design software such as Figma, Adobe XD or Sketch.</li>
            <li>Deep understanding of visual design principles (including typography, color theory, layout, and grid systems).</li>
          </ul>
        </section>

        <section class="job-part">
          <h4>Preferred <span class="yellow-text">Requirements</span></h4>
          <ul>
            <li>Has basic knowledge of implementing HTML5 and CSS3 from designs.</li>
            <li>Has experience working in an agency environment, which is a significant advantage.</li>
          </ul>
        </section>

        <a href="apply.php" class="apply-button">Apply now</a>
      </article>
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