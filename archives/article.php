<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Blog</h1>
        </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>







<?php
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM blog WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();
?>


    <h1><?= htmlspecialchars($article['title']) ?></h1>
    <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
