<?php
include 'includes/config.php';
include 'includes/header.php';

session_start();

$stmt = $pdo->prepare("SELECT messages.content, messages.created_at, users.username FROM messages JOIN users ON messages.user_id = users.id ORDER BY messages.created_at DESC");
$stmt->execute();
$messages = $stmt->fetchAll();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    echo "Bienvenue, " . htmlspecialchars($_SESSION['username']) . "! <a href='logout.php'>Déconnexion</a><br>";
    echo "<a href='post_message.php'>Ajouter un message</a><br><br>";
} else {
    echo "Bienvenue, invité ! <a href='login.php'>Connectez-vous</a> ou <a href='register.php'>Inscrivez-vous</a><br><br>";
}

foreach ($messages as $message) {
    echo "<div><strong>" . htmlspecialchars($message['username']) . ":</strong> " . htmlspecialchars($message['content']) . "<br><em>" . $message['created_at'] . "</em></div><br>";
}

include 'includes/footer.php';
?>
