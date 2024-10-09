<?php
include 'includes/config.php';
include 'includes/header.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = trim($_POST['content']);

    if (!empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO messages (user_id, content) VALUES (?, ?)");
        $stmt->execute([$_SESSION['user_id'], $content]);
        echo "Message ajouté.";
        header("Location: index.php");
    } else {
        echo "Le message ne peut pas être vide.";
    }
}
?>

<form method="POST" action="">
    <textarea name="content" placeholder="Votre message" required></textarea><br>
    <button type="submit">Envoyer</button>
</form>

<?php include 'includes/footer.php'; ?>
