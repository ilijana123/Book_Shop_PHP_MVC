<?php include '../view/header.php'; ?>
<div id="main" class="container-fluid" style="padding-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="border p-4 rounded" style="background-color: #fff3e6;">
                <h1 class="text-center mb-4">Add Author</h1>
                <form action="index.php" method="post" id="add_author_form">
                    <input type="hidden" name="action" value="add_author" />

                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="author_name" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Nationality:</label>
                        <input type="text" name="nationality" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Birth Date:</label>
                        <input type="date" name="birth_date" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Gender:</label>
                        <select name="gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <input type="submit" value="Add Author" class="btn btn-success" />
                        <a href="index.php?action=list_authors" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../view/footer.php'; ?>
