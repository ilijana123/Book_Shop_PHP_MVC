<?php include '../view/header.php'; ?>

<div class="container-fluid" style="padding-top: 100px; text-align: center; background-color: antiquewhite;">
    <h2 style="color: coral;">Genres</h2>

    <!-- Displaying genres -->
    <?php foreach ($genres as $genre) : ?>
        <div class="genre-item">
            <h3><?php echo htmlspecialchars($genre['genreName']); ?></h3>
            <form action="index.php" method="post">
                <input type="hidden" name="action" value="delete_genre">
                <input type="hidden" name="genre_id" value="<?php echo $genre['genreID']; ?>">
            </form> 
        </div>
    <?php endforeach; ?>

    <!-- Link to add new genre form
    <a class="btn-add" href="?action=show_add_form" style="background-color: coral; color: white; padding: 10px 20px; text-decoration: none; margin-top: 20px; display: inline-block; border-radius: 5px;">Add New Genre</a> -->
</div>

<?php include '../view/footer.php'; ?>
