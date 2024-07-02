<?php include '../view/header.php'; ?>

<div class="container" style="padding-top: 100px; text-align: center;">
    <h2 style="color: coral;">Genres</h2>

    <!-- Displaying genres -->
    <?php foreach ($genres as $genre) : ?>
        <div class="genre-item">
            <h3><?php echo htmlspecialchars($genre['genreName']); ?></h3>
            <?php if ($is_admin_logged_in): ?>
                <form action="index.php" method="post" style="display: inline-block;">
                    <input type="hidden" name="action" value="delete_genre">
                    <input type="hidden" name="genre_id" value="<?php echo $genre['genreID']; ?>">
                    <input type="submit" class="btn btn-primary" style="background-color: red; color: white; padding: 10px 20px; text-decoration: none; margin-top: 10px; display: inline-block; border-radius: 5px;" value="Delete">
                </form>
                <a href="?action=show_edit_form&genre_id=<?php echo $genre['genreID']; ?>" class="btn btn-primary" style="background-color: coral; color: white; padding: 10px 20px; text-decoration: none; margin-top: 10px; display: inline-block; border-radius: 5px;">Edit</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <!-- Link to add new genre form -->
    <?php if ($is_admin_logged_in): ?>
        <a class="btn-add" href="?action=show_add_form" style="background-color: coral; color: white; padding: 10px 20px; text-decoration: none; margin-top: 20px; display: inline-block; border-radius: 5px;">Add New Genre</a>
    <?php endif; ?>
</div>

<?php include '../view/footer.php'; ?>
