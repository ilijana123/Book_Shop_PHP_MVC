<?php include '../view/header.php'; ?>

<div class="container" style="padding-top: 100px; text-align: center;">
    <h2 style="color: coral;">Edit Genre</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="edit_genre">
        <input type="hidden" name="genre_id" value="<?php echo $genre['genreID']; ?>">
        <label for="genre_name">Genre Name:</label>
        <input type="text" name="genre_name" id="genre_name" value="<?php echo htmlspecialchars($genre['genreName']); ?>" required>
        <input type="submit" value="Update Genre" style="background-color: coral; color: white; padding: 10px 20px; border-radius: 5px;">
    </form>
</div>

<?php include '../view/footer.php'; ?>