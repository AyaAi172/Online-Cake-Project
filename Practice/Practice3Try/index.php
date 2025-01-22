<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Handle navigation and determine current page
$page = isset($_GET['page']) ? $_GET['page'] : 'guess';

// Handle form submission for guesses
$message = "";
if ($page === 'guess' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $guess = trim($_POST['guess']); // Remove spaces

    // Read correct words from correct.txt
    $correctWords = file('correct.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (in_array($guess, $correctWords)) {
        $message = "<h1>YOU NAILED IT</h1>";
    } else {
        $message = "You missed it";

        // Save incorrect guess to tries.txt
        file_put_contents('tries.txt', $guess . PHP_EOL, FILE_APPEND);
    }
}

// Read tries for displaying guesses
$tries = file('tries.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$totalTries = count($tries);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guess the Word</title>
    <style>
        a {
            margin-right: 10px;
            text-decoration: none;
            color: black;
        }
        a.active {
            font-weight: bold;
            color: red;
        }
        div {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <!-- Navigation Links -->
    <div>
        <a href="?page=guess" class="<?= $page === 'guess' ? 'active' : '' ?>">Guess Page</a>
        <a href="?page=show_guesses" class="<?= $page === 'show_guesses' ? 'active' : '' ?>">Show Guesses</a>
    </div>

    <?php if ($page === 'guess'): ?>
        <!-- Guess Page -->
        <h1>Guess the Word</h1>
        <?php if (empty($message)): ?>
            <form method="POST">
                <input type="text" name="guess" placeholder="Enter your guess" required>
                <button type="submit">Submit</button>
            </form>
        <?php else: ?>
            <p><?= $message ?></p>
        <?php endif; ?>

    <?php elseif ($page === 'show_guesses'): ?>
        <!-- Show Guesses Page -->
        <h1>Previous Guesses</h1>
        <?php if ($totalTries > 0): ?>
            <?php foreach ($tries as $try): ?>
                <div><?= htmlspecialchars($try) ?></div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No guesses yet!</p>
        <?php endif; ?>
        <h2>Total Tries: <?= $totalTries ?></h2>
    <?php endif; ?>

</body>
</html>

</body>
</html>