<?php
    // 1. Block direct URL or Get method
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') 
    // if the request method is null, return an empty string
    {
        header('Location: apply.php');
        exit;
    }

    // Variables Initialization
    $error = [];
    $l_name = "";
    $f_name = "";
    $dob = "";
    $gender = "";
    $email = "";
    $phone = 0;
    $street = "";
    $suburb = "";
    $state = "";
    $post_code = 0;
    $ref_num = "";
    $skill_list = [];
    $other_skill = "";
    $consent = false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <link href="page_css/Apply/apply_var_style.css" rel="stylesheet">
    <link href="page_css/process_eoi.css" rel="stylesheet">
    <title>EOI</title>
</head>

<body>
    
</body>

</html>