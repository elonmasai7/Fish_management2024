<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
    $stmt->execute([$user_id, $message]);
}

$messages = $pdo->query("SELECT m.message, m.timestamp, u.username FROM messages m JOIN users u ON m.user_id = u.id ORDER BY m.timestamp DESC")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    <form method="POST">
        <textarea name="message" placeholder="Enter your message" required></textarea>
        <button type="submit">Post</button>
    </form>
    <h2>Messages</h2>
    <?php foreach ($messages as $message): ?>
        <p><strong><?php echo htmlspecialchars($message['username']); ?></strong>: <?php echo htmlspecialchars($message['message']); ?> <em><?php echo $message['timestamp']; ?></em></p>
    <?php endforeach; ?>
</body>
</html>
