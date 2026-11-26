For navigation bar and footer:
Copy everything in the nav.html and footer.html and paste it into your page.html, pull style.css to the latest version and everything should work fine.

----
For division bar and end button:

Paste <div class="yel_bar_section"></div> into every space between your sections except for the last one to footer (because I already put margin for end buton section)

Give your end button's holder the id="end_button" and the links inside it the class="button" and remove every styling you gave them except for text styling.

----
Synchroization Notice:
Since I set the <body></body>'s margin already, you should not set your section's margin or padding intro anything other than 0px unless you intentionally want more space.

----

DATABASE CONNECTION (settings.php)

See jobs.php for a full working example.

1. settings.php
settings.php (root folder) only stores the 4 details needed to connect to MySQL:
- $host = "localhost"
- $user = "root"
- $pwd = "" (no password, as required by the brief)
- $sql_db = "database_gito_gatos"
Do NOT write these details in your own page. Always use settings.phpư

2. How to connect in your page
Copy these 3 lines to the TOP of your page (before <!DOCTYPE html>). Do not change them (you can check jobs.php for example):

<?php
  require_once "settings.php";
  mysqli_report(MYSQLI_REPORT_OFF);
  $conn = mysqli_connect($host, $user, $pwd, $sql_db);
?>

3. Error messages (copy this, then EDIT it for your page)
P/S: To be honest, you dont really need to copy the same as the code below. As we know, it is hard to understand someone's code, so you can redesign and write by your own knowledge, the most important thing is the styled error message that in the "cat language":D, we just need consistency here!

Every page has different data, so copy the template below and change:
- the SQL query (your table and columns)
- the 3 messages
- the part that shows the data (inside the last else)

NOTE: css 'job-message' is just used and worked for jobs.php (jobs.css) only, if you want to design the error message in your own page, please do not copy, you should change them and edit in your own css page.

<?php
  if (!$conn) {
    echo "<p class='job-message'>Meow! Our cat chewed through the database cable. Try again later!</p>";
  } else {
    $sql = "SELECT * FROM your_table";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
      echo "<p class='job-message'>A cat walked across the keyboard and broke the query. Debugging meow...</p>";
    } elseif (mysqli_num_rows($result) == 0) {
      echo "<p class='job-message'>No positions open. We are simply too purr-fect to hire right now.</p>";
    } else {
      while ($row = mysqli_fetch_assoc($result)) {
        // CHANGE: show your data here, for example:
        echo "<p>" . htmlspecialchars($row["your_column"]) . "</p>";
      }
    }

    mysqli_close($conn);
  }
?>

Notes:
- Use htmlspecialchars() when you echo data from the database.
- For INSERT, UPDATE or DELETE there are no rows to show, so use:
  if ($result) { success message } else { error message }
  (no need for mysqli_num_rows)
- Do not show mysqli_error() or database names to users.

4. How to test your page
- Normal: change some data in phpMyAdmin, refresh the page and check that it changes.
- Cannot connect: stop MySQL in XAMPP and refresh.
- Query error: change the table name in your SQL to a wrong name and refresh.
- No records: add WHERE with a value that does not exist and refresh.

See jobs.php for a full working example.
Reference: COS10026 Week 9 lecture, Connecting PHP to MySQL.