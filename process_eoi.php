<?php
    // Block direct URL or Get method
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: apply.php");
        exit;
    }

    // Input cleaning functions
    function clean_string(string $data): string
    {
        if (!isset($_POST[$data]) || !is_string($_POST[$data])) {
            return '';
        }
        $a = trim($_POST[$data]);
        $b = stripslashes($a);
        return $b;
    }

    function clean_array(string $data): array
    {
        if (!isset($_POST[$data]) || !is_array($_POST[$data])) {
            return [];
        }
        $clean_array = [];
        foreach ($_POST[$data] as $a) {
            if (is_string($a)) {
                $b = stripslashes($a);
                $c = trim($b);
                if ($c !== '') {
                    $clean_array[] = $c;
                }
            }
        }
        return $clean_array;
    }

    // helper functions
    function string_max_length(string $str, int $max): bool
    {
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
        'last_name' => clean_string('L_name' ?? ''),
        'first_name' => clean_string('F_name' ?? ''),
        'dob' => clean_string('bdate' ?? ''),
        'gender' => clean_string('gender' ?? ''),
        'email' => clean_string('email' ?? ''),
        'phone' => clean_string('phone' ?? ''),
        'street' => clean_string('street' ?? ''),
        'suburb' => clean_string('suburb' ?? ''),
        'state' => clean_string('state' ?? ''),
        'post_code' => clean_string('postcode' ?? ''),
        'ref_num' => clean_string('ref_num' ?? ''),
        'skill_des' => clean_array('skill_des' ?? []),
        'skill_fed' => clean_array('skill_fed' ?? []),
        'other_skill' => clean_string('other_skill' ?? ''),
        'consent' => clean_string('consent' ?? ''),
    ];

    // input validation
    // first name
    if ($filled['first_name'] === '') {
        $error[] = 'You need to enter your first name.';
    } elseif (!preg_match('/^[A-Za-z]+$/', $filled['first_name'])) {
        $error[] = 'Your first name contain non-letter character.';
    } elseif (string_max_length($filled['first_name'], 20) == TRUE) {
        $error[] = 'Your first name is longer than 20 characters.';
    };

    // last name
    if ($filled['last_name'] === '') {
        $error[] = 'You need to enter your last name.';
    } elseif (!preg_match('/^[A-Za-z]+$/', $filled['last_name'])) {
        $error[] = 'Your last name contain non-letter character.';
    } elseif (string_max_length($filled['last_name'], 20) === TRUE) {
        $error[] = 'Your last name is longer than 20 characters.';
    };

    // date of birth
    $min_age = 16;
    $max_age = 85;
    $format = 'd/m/Y';
    $dob = DateTime::createFromFormat($format, $filled['dob']);

    if ($filled['dob'] === '') {
        $error[] = 'You need to enter your birth date.';
    } elseif (!$dob || $dob->format($format) !== $filled['dob']) {
        $error[] = 'Your birth date is not valid or wrong format.';
    } else {
        $dob->setTime(0, 0, 0);
        $today = new DateTime('today');
        $age = $today->diff($dob)->y;
        if ($dob > $today) {
            $error[] = 'Your birth date is in the future.';
        } elseif ($age < $min_age) {
            $error[] = 'You are too young for this position.';
        } elseif ($age > $max_age) {
            $error[] = 'You are too old for this position.';
        }
    }

    // gender
    $allowed_gender = ['Female', 'Male', 'Others'];
    if ($filled['gender'] === '') {
        $error[] = 'You need to choose your gender.';
    } elseif (!in_array($filled['gender'], $allowed_gender, TRUE)) {
        $error[] = 'Your gender choice is not valid.';
    };
    // email
    if ($filled['email'] === '') {
        $error[] = 'You need to enter your email.';
    } elseif (strlen($filled['email']) > 254) {
        $error[] = 'Your email is too long.';
    } elseif (filter_var($filled['email'], FILTER_VALIDATE_EMAIL) === FALSE) {
        $error[] = 'Your email format is not valid.';
    };
    // phone number
    $cleaned_phone = preg_replace('/[\s\-\.\(\)]+/', '', $filled['phone']);
    $pattern = '/^\+?[0-9]{8,12}$/';
    if ($cleaned_phone === '') {
        $error[] = 'You need to enter your phone number.';
    } elseif (!preg_match($pattern, $cleaned_phone)) {
        $error[] = 'Your phone number must be 8 to 12 digits.';
    };
    // street
    if ($filled['street'] === '') {
        $error[] = 'You need to enter your street address.';
    } elseif (mb_strlen($filled['street']) > 40) {
        $error[] = 'Your street address is longer than 40 characters.';
    }
    // suburb
    if ($filled['suburb'] === '') {
        $error[] = 'You need to enter your sub-urban address.';
    } elseif (mb_strlen($filled['suburb']) > 40) {
        $error[] = 'Your sub-urban address is longer than 40 characters.';
    }
    // state $ post code 
    $allowed_state = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
    $state_valid = FALSE;
    if ($filled['state'] === '') {
        $error[] = 'You need to choose your state.';
    } elseif (!in_array($filled['state'], $allowed_state, TRUE)) {
        $error[] = 'Your state choice is not valid.';
    } else {
        $state_valid = TRUE;
    };
    $cleaned_post_code = preg_replace('/[\s\-\.\(\)]+/', '', $filled['post_code']);
    $pattern = '/^[0-9]{4}$/';
    $post_code_valid = FALSE;
    if ($cleaned_post_code === '') {
        $error[] = 'You need to enter your post code.';
    } elseif (!preg_match($pattern, $cleaned_post_code)) {
        $error[] = 'Your post code must be 4 digits.';
    } else {
        $post_code_valid = TRUE;
    };
    // cross check matched state % post code
    $post_code_prefix = [
        'VIC' => ['3', '8'],
        'NSW' => ['1', '2'],
        'QLD' => ['4', '9'],
        'NT' => ['0'],
        'WA' => ['6'],
        'SA' => ['5'],
        'TAS' => ['7'],
        'ACT' => ['0'],
    ];
    if ($post_code_valid && $state_valid) {
        $first_number = $cleaned_post_code[0];
        if (!in_array($first_number, $post_code_prefix[$filled['state']], TRUE)) {
            $error[] = 'Your post code does not match your state.';
        }
    };
    // reference number
    $allowed_ref_num = ['FED01', 'UID02'];
    if ($filled['ref_num'] === '') {
        $error[] = 'You need to choose your job reference number.';
    } elseif (!in_array($filled['ref_num'], $allowed_ref_num, TRUE)) {
        $error[] = 'Your job reference number is not valid.';
    }
    // reference number
    if ($filled['consent'] === '') {
        $error[] = 'You need tick to agree to consent terms.';
    } elseif ($filled['consent'] !== 'consent') {
        $error[] = 'Your consent input is not valid.';
    };

    // send error and valid inputs back to apply
    if (!empty($error)) {
        $_SESSION['flash_error'] = $error;
        $_SESSION['flash_valid'] = $filled;
        header("Location: apply.php");
        exit;
    }

    // delete old inputs (if there's any) and then INSERT into MySQL
    unset($_SESSION['flash_error'], $_SESSION['flash_valid']);
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