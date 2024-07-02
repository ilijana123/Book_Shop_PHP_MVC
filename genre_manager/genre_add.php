<?php include '../view/header.php'; ?>
<div id="main" class="container-fluid" style="padding-top: 80px;">
    <h1>Add Genre</h1>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add_genre">
        <label for="genre_name">Genre Name:</label>
        <input type="text" id="genre_name" name="genre_name" required>
        <button type="submit">Add Genre</button>
    </form>
</div>