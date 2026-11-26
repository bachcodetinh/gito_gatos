<?php
    // Block direct URL or Get method
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: apply.php");
        exit;
    }

    // Input cleaning functions
    function clean_string(string $data): string{
        if (!isset($_POST[$data]) || !is_string($_POST[$data])) {
            return '';
        }
        $a = trim($_POST[$data]);
        $b = stripslashes($a);
        return $b;
    }

    function clean_array(string $data): array {
        if (!isset($_POST[$data]) || !is_array($_POST[$data])) {
            return [];
        }
        $clean_array = [];
        foreach ($_POST[$data] as $a) {
            if (is_string($a)){
                $b = stripslashes($a);
                $c = trim($b);
                if ($c !== ''){
                    $clean_array[] = $c;
                }
            }
        }
        return $clean_array;
    }

    // helper functions
    function string_max_length(string $str,int $max): bool{
        $length = mb_strlen($str, 'UTF-8');
        if ($length > $max) {
            return TRUE;
        };
        return FALSE;
    }

    // error array 
    $error = [];

    // everything the user filled in the form
    $filled = [
        'last_name' => clean_string($_POST['L_name'] ?? ''),
        'first_name' => clean_string($_POST['F_name'] ?? ''),
        'dob' => clean_string($_POST['bdate']),
        'gender' => clean_string($_POST['gender'] ?? ''),
        'email' => clean_string($_POST['email'] ?? ''),
        'phone' => clean_string($_POST['phone'] ?? ''),
        'street' => clean_string($_POST['street'] ?? ''),
        'suburb' => clean_string($_POST['suburb'] ?? ''),
        'state' => clean_string($_POST['state'] ?? ''),
        'post_code' => clean_string($_POST['postcode'] ?? ''),
        'ref_num' => clean_string($_POST['ref_num'] ?? ''),
        'skill_des' => clean_array($_POST['skill_des'] ?? []),
        'skill_fed' => clean_array($_POST['skill_fed'] ?? []),
        'other_skill' => clean_string($_POST['other_skill'] ?? ''),
        'consent' => clean_string($_POST['consent'] ?? ''),
    ];
    
    // input validation
    // first name
    if ($filled['first_name'] === ''){
        $error[] = 'You need to enter your first name.';
    }
    elseif (string_max_length($filled['first_name'], 20) == TRUE) {
        $error[] = 'Your first name is longer than 20 characters.';
    };

    // last name
    if ($filled['last_name'] === ''){
        $error[] = 'You need to enter your last name.';
    }
    elseif (string_max_length($filled['last_name'], 20) === TRUE) {
        $error[] = 'Your last name is longer than 20 characters.';
    };

    // date of birth
    $min_age = 16;
    $max_age = 85;
    $format = 'd/m/Y';
    $dob = DateTime::createFromFormat($format, $filled['dob']);
    $dob->setTime(0,0,0);
    $today = new DateTime('today');
    $age = $today->diff($dob)->y;

    if ($filled['dob'] === ''){
        $error[] = 'You need to enter your birth date.';
    }
    elseif (!$dob || $dob->format($format) !== $filled['dob']) {
        $error[] = 'Your birth date is not valid or wrong format.';
    }
    elseif ($dob > $today) {
        $error [] = 'Your birth date is in the future.';
    }
    elseif ($age < $min_age) {
        $error [] = 'You are too young for this position.';
    }
    elseif ($age > $max_age) {
        $error [] = 'You are too old for this position.';
    }
    // gender
    $allowed_gender = ['Female','Male','Other'];
    if ($filled['gender'] === '') {
        $error [] = 'You need to choose your gender.';
    }
    elseif (!in_array($filled['gender'], $allowed_gender, TRUE)) {
        $error [] = 'Your gender choice is not valid.';
    };
    // email
    if ($filled['email'] === '') {
        $error [] = 'You need to enter your email.';
    }
    elseif (strlen($filled['email']) > 254) {
        $error [] = 'Your email is too long.';
    }
    elseif (filter_var($filled['email'], FILTER_VALIDATE_EMAIL) === FALSE) {
        $error [] = 'Your email format is not valid.';
    };
    // phone number
    $cleaned_phone = preg_replace('/[\s\-\.\(\)]+/', '', $filled['phone']);
    $pattern = '/^\+?[0-9]{8,12}$/';
    if ($cleaned_phone === '') {
        $error [] = 'You need to enter your phone number.';
    }
    elseif (!preg_match($pattern, $cleaned_phone)) {
        $error [] = 'Your phone number must be 8 to 12 digits.';
    };
    // street
    if ($filled['street'] === '') {
        $error [] = 'You need to enter your street address.';
    }
    elseif (mb_strlen($filled['street']) > 40) {
        $error [] = 'Your street address is longer than 40 characters.';
    }
    // suburb
    if ($filled['suburb'] === '') {
        $error [] = 'You need to enter your sub-urban address.';
    }
    elseif (mb_strlen($filled['suburb']) > 40) {
        $error [] = 'Your sub-urban address is longer than 40 characters.';
    }
    // state
    $allowed_state = ['VIC','NSW','QLD','NT','WA','SA','TAS','ACT'];
    if ($filled['state'] === '') {
        $error [] = 'You need to choose your state.';
    }
    elseif (!in_array($filled['state'], $allowed_state, TRUE)) {
        $error [] = 'Your state choice is not valid.';
    }
    // post code 
    $cleaned_post_code = preg_replace('/[\s\-\.\(\)]+/', '', $filled['post_code']);
    $pattern = '/^?[0-9]{4}$/';
    if ($cleaned_post_code === '') {
        $error [] = 'You need to enter your post code.';
    }
    elseif (!preg_match($pattern, $cleaned_post_code)) {
        $error [] = 'Your post code must be 4 digits.';
    };
    // reference number
    $allowed_ref_num = ['FED01','UID02'];
    if ($filled['ref_num'] === '') {
        $error [] = 'You need to choose your job reference number.';
    }
    elseif (!in_array($filled['ref_num'], $allowed_state, TRUE)) {
        $error [] = 'Your job reference number is not valid.';
    }
    // reference number
    if ($filled['consent'] === '') {
        $error [] = 'You need tick to agree to consent terms.';
    }
    elseif (!$filled['consent'] === 'consent') {
        $error [] = 'Your consent input is not valid.';
    }
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