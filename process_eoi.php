<?php
    // 1. Block direct URL or Get method and
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') 
    // if the request method is null, return an empty string
    {
        header('Location: apply.php');
        exit;
    }

    // neutralize all HTML output
    function neutral_html(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    // Helper for normalizing free-text fields (street, suburb, other_skill)
    function clean_string_input(string $input): string
    {
        if (!isset($_POST[$input]) || !is_string($_POST[$input])) {
            // If the input is empty or not a string, return empty string
            return '';
        }
        $cleaned_input = trim($_POST[$input]);
        // Remove white spaces from both ends
        $cleaned_input = preg_replace('/\s+/u', ' ', $cleaned_input);
        // Replace multiple spaces with a space. /u is for unicode multi-byte characters like vietnamese
        $cleaned_input= preg_replace('/[\x00-\x1F\x7F]/u', '', $cleaned_input);
        return $cleaned_input;
        // Remove invisible ASCII characters
    }

    // array to store all errored inputs
    $errors = [];

    // 1. Job reference number: exactly 5 alphanumeric characters
    $ref_num = isset($_POST['ref_num']) && is_string($_POST['ref_num']) ? trim($_POST['ref_num']) : '';
    if ($ref_num === '') {
        $errors['ref_num'] = 'Job reference number is required.';
    } elseif (preg_match('/^[A-Za-z0-9]{5}$/', $ref_num) !== 1) {
        $errors['ref_num'] = 'Job reference number must be exactly 5 alphanumeric characters.';
    }

    // 2. First name: max 20 alpha characters
    $f_name = isset($_POST['F_name']) && is_string($_POST['F_name']) ? trim($_POST['F_name']) : '';
    if ($f_name === '') {
        $errors['F_name'] = 'First name is required.';
    } elseif (mb_strlen($f_name, 'UTF-8') > 20 || preg_match('/^[A-Za-z]+$/', $f_name) !== 1) {
        $errors['F_name'] = 'First name must contain only letters (max 20 characters).';
    }

    // 3. Last name: max 20 alpha characters
    $l_name = isset($_POST['L_name']) && is_string($_POST['L_name']) ? trim($_POST['L_name']) : '';
    if ($l_name === '') {
        $errors['L_name'] = 'Last name is required.';
    } elseif (mb_strlen($l_name, 'UTF-8') > 20 || preg_match('/^[A-Za-z]+$/', $l_name) !== 1) {
        $errors['L_name'] = 'Last name must contain only letters (max 20 characters).';
    }

    // 4. Date of birth: valid dd/mm/yyyy
    $bdate = isset($_POST['bdate']) && is_string($_POST['bdate']) ? trim($_POST['bdate']) : '';
    if ($bdate === '') {
        $errors['bdate'] = 'Date of birth is required.';
    } elseif (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $bdate, $matches) !== 1) {
        $errors['bdate'] = 'Date of birth must be in dd/mm/yyyy format.';
    } elseif (!checkdate((int)$matches[2], (int)$matches[1], (int)$matches[3])) {
        $errors['bdate'] = 'Please enter a real calendar date.';
    }

    // 5. Gender: radio allowlist
    $allowed_genders = ['Female', 'Male', 'Others'];
    $gender = isset($_POST['gender']) && is_string($_POST['gender']) ? trim($_POST['gender']) : '';
    if ($gender === '') {
        $errors['gender'] = 'Please select a gender.';
    } elseif (!in_array($gender, $allowed_genders, true)) {
        $errors['gender'] = 'Invalid gender selected.';
    }

    // 6. Street Address: max 40 chars
    $street = clean_string_input('street');
    if ($street === '') {
        $errors['street'] = 'Street address is required.';
    } elseif (mb_strlen($street, 'UTF-8') > 40) {
        $errors['street'] = 'Street address must be 40 characters or fewer.';
    } elseif (preg_match('/^[\p{L}\p{N}\s\.,#\-\/\'()&]+$/u', $street) !== 1) {
        $errors['street'] = 'Street address contains invalid characters.';
    }

    // 7. Suburb/Town: max 40 chars
    $suburb = clean_string_input('suburb');
    if ($suburb === '') {
        $errors['suburb'] = 'Suburb/Town is required.';
    } elseif (mb_strlen($suburb, 'UTF-8') > 40) {
        $errors['suburb'] = 'Suburb/Town must be 40 characters or fewer.';
    } elseif (preg_match('/^[\p{L}\s\.\-\']+$/u', $suburb) !== 1) {
        $errors['suburb'] = 'Suburb/Town contains invalid characters.';
    }

    // 8. State: dropdown allowlist
    $allowed_states = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
    $state = isset($_POST['state']) && is_string($_POST['state']) ? trim($_POST['state']) : '';
    if ($state === '') {
        $errors['state'] = 'Please select a state.';
    } elseif (!in_array($state, $allowed_states, true)) {
        $errors['state'] = 'Invalid state selected.';
    }

    // 9. Postcode: exactly 4 digits
    $postcode = isset($_POST['postcode']) && is_string($_POST['postcode']) ? trim($_POST['postcode']) : '';
    if ($postcode === '') {
        $errors['postcode'] = 'Postcode is required.';
    } elseif (preg_match('/^[0-9]{4}$/', $postcode) !== 1) {
        $errors['postcode'] = 'Postcode must be exactly 4 digits.';
    }

    // 10. Email: valid format
    $email = isset($_POST['email']) && is_string($_POST['email']) ? trim($_POST['email']) : '';
    if ($email === '') {
        $errors['email'] = 'Email is required.';
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // 11. Phone number: 8-12 digits, no spaces
    $phone = isset($_POST['phone']) && is_string($_POST['phone']) ? trim($_POST['phone']) : '';
    if ($phone === '') {
        $errors['phone'] = 'Phone number is required.';
    } elseif (preg_match('/^[0-9]{8,12}$/', $phone) !== 1) {
        $errors['phone'] = 'Phone number must be 8 to 12 digits with no spaces.';
    }

    // 12. Skill list: Required at least 1
    $allowed_des = array_map(fn($n) => "skill_des$n", range(1, 12));
    $allowed_fed = array_map(fn($n) => "skill_fed$n", range(1, 13));

    $raw_des = (isset($_POST['skill_des']) && is_array($_POST['skill_des'])) ? $_POST['skill_des'] : [];
    $raw_fed = (isset($_POST['skill_fed']) && is_array($_POST['skill_fed'])) ? $_POST['skill_fed'] : [];

    $valid_des = array_values(array_filter($raw_des, fn($s) => is_string($s) && in_array($s, $allowed_des, true)));
    $valid_fed = array_values(array_filter($raw_fed, fn($s) => is_string($s) && in_array($s, $allowed_fed, true)));
    $all_skills = array_merge($valid_des, $valid_fed);

    if (empty($all_skills)) {
        $errors['skills'] = 'Please select at least one skill.';
    }

    // 13. Other skills: Optional textarea
    $other_skill = clean_string_input('other_skill');

    // 14. Consent checkbox (present in apply.php)
    $consent = isset($_POST['consent']) && $_POST['consent'] === 'consent';
    if (!$consent) {
        $errors['consent'] = 'You must agree to the Collection Notice before applying.';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EOI</title>
</head>

<body>
    <?php if (!empty($errors)): ?>
        <h1>Application Could Not Be Submitted</h1>
        <p>Please fix the following errors:</p>
        <ul>
            <?php foreach ($errors as $message): ?>
                <li><?= neutral_html($message) ?></li>
            <?php endforeach; ?>
        </ul>
        <p><a href="apply.php">Go back to the form</a></p>
    <?php else: ?>
        <h1>Application Received</h1>
        <p>Thank you, <?= neutral_html($f_name . ' ' . $l_name) ?>. Your application for <strong><?= neutral_html($ref_num) ?></strong> passed validation.</p>
        <!-- Next user story: insert cleaned fields into MySQL eoi table using PDO/mysqli prepared statements -->
    <?php endif; ?>
</body>

</html>