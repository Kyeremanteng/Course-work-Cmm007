<?php

session_start();

if (isset($_GET['update']) && $_GET['update'] == 'successfulEdit') {
    echo '<script>alert("Recipe updated successfully!");</script>';
    // Clear the message to prevent it from being displayed on refresh or navigation
    unset($_SESSION['message']);
}
if (isset($_GET['update']) && $_GET['update'] == 'successfulEditU') {
    echo '<script>alert("User updated successfully!");</script>';
    // Clear the message to prevent it from being displayed on refresh or navigation
    unset($_SESSION['message']);
}

require_once 'functions/config.php';

// Ensure the user is logged in
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id']; // Get the logged-in user's ID


// Initialize an array to hold the recipes
$recipes = [];
$users = [];

// Prepare the SQL statement to fetch recipes
$sql = "SELECT recipes.title, recipes.description, recipes.datePosted, recipes.regionFlag, recipes.instructions, recipes.ingredients, users.uname, users.email FROM recipes INNER JOIN users ON recipes.userId = users.userid ORDER BY users.uname DESC, recipes.datePosted DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$recipes = [];
while ($row = $result->fetch_assoc()) {
    $recipes[] = $row;
}

// Prepare the SQL statement to fetch users
$sql2 = "SELECT uname, email, telephone, bio FROM users ORDER BY users.uname ASC";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$result2 = $stmt2->get_result();

$users = [];
while ($row = $result2->fetch_assoc()) {
    $users[] = $row;
}

?>

<?php include 'header.php'; ?>
<main>
    <div class="container text-center">
        <h1>Admin Panel</h1>
    </div>
    <div class="container-sm text-center">
        <div class="row gx-5">
            <p><?php echo 'Hello, ' . htmlspecialchars($_SESSION['user_name']) . '!'. ' Welcome to your dashboard.'; ?>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRecipe">
            Add Recipe
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
            Add User
        </button>
        <br>
        <br>
    </div>
    <div class="container-sm">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Manage Users <i class="fas fa-users" style="margin-left: 10px;"></i>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse bg-light collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="container-flex">
                            <div class="row text-center">
                                <br>
                                <h5>User List</h5>
                                <br>
                            </div>
                            <div class="row">
                                <table class="table table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td>
                                                <?php echo htmlspecialchars($user['uname']); ?></td>
                                            <td>
                                                <?php echo htmlspecialchars($user['email']); ?></td>
                                            </td>
                                            <td>
                                                <button id="editUserBtn" type="button" class="btn btn-primary"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    data-bs-toggle="modal" data-bs-target="#editUser"
                                                    data-user-name="<?php echo htmlspecialchars($user['uname']); ?>"
                                                    data-user-email="<?php echo htmlspecialchars($user['email']); ?>"
                                                    data-user-telephone="<?php echo htmlspecialchars($user['telephone']); ?>"
                                                    data-user-bio="<?php echo htmlspecialchars($user['bio']); ?>"
                                                    title="Edit User"><i class="fas fa-pencil-alt"></i></button>
                                                <button type="button" class="btn btn-danger"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    onclick="if(confirm('Are you sure?')) window.location.href='functions/delete_User.php?email=<?php echo urlencode($user['email']); ?>';"
                                                    title="Delete User"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Manage Recipes <i class="fas fa-book" style="margin-left: 10px;"></i>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse bg-light collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="container-sm">
                            <div class="row text-center">
                                <br>
                                <h5>Recipes</h5>
                                <br>
                            </div>
                            <div class="row">
                                <table class="table table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Chef</th>
                                            <th scope="col">Date Posted</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php foreach ($recipes as $recipe): ?>
                                        <tr>
                                            <td>
                                                <?php echo htmlspecialchars($recipe['title']); ?></td>
                                            <td>
                                                <?php
                        // Truncate the description after 60 characters
                        $description = htmlspecialchars($recipe['description']);
                        echo (strlen($description) > 60) ? substr($description, 0, 60) . '...' : $description;
                        ?>
                                            </td>
                                            <td>
                                                <?php echo htmlspecialchars($recipe['uname']); ?></td>
                                            <td>
                                                <?php 
                        $date = new DateTime($recipe['datePosted']);
                        echo $date->format('j F, Y'); 
                        ?>
                                            </td>
                                            <td>
                                                <button id="uploadFileBtn" type="button" class="btn btn-primary"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    data-bs-toggle="modal" data-bs-target="#addFile"
                                                    data-recipe-title="<?php echo htmlspecialchars($recipe['title']); ?>"
                                                    title="Upload Image"><i class="fas fa-paperclip"></i></button>
                                                <button id="editRecipeBtn" type="button" class="btn btn-primary"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    data-bs-toggle="modal" data-bs-target="#editRecipe"
                                                    data-recipe-title="<?php echo htmlspecialchars($recipe['title']); ?>"
                                                    data-recipe-description="<?php echo htmlspecialchars($recipe['description']); ?>"
                                                    data-recipe-regionFlag="<?php echo htmlspecialchars($recipe['regionFlag']); ?>"
                                                    data-recipe-ingredients="<?php echo htmlspecialchars($recipe['ingredients']); ?>"
                                                    data-recipe-instructions="<?php echo htmlspecialchars($recipe['instructions']); ?>"
                                                    title="Edit Recipe"><i class="fas fa-pencil-alt"></i></button>
                                                <button type="button" class="btn btn-danger"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    onclick="if(confirm('Are you sure?')) window.location.href='functions/delete_recipe.php?title=<?php echo urlencode($recipe['title']); ?>';"
                                                    title="Delete Recipe"><i class="fas fa-trash"></i></button>

                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modals -->

    <!-- Add User -->
    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addUserLabel">Add User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="container-sm">
                    <div class="col">
                        <form action="functions/admin_add_user.php" method="post" enctype="multipart/form-data">
                            <br>
                            <br>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="name" class="form-control" id="name" name="name" placeholder="First Last"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="name@example.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="telephone" class="form-label">Telephone (Optional)</label>
                                <input type="telephone" class="form-control" id="telephone" name="telephone"
                                    placeholder="+44 123 456 7890">
                            </div>
                            <div class="mb-3">
                                <label for="userRole" class="form-label">User Role</label>
                                <select class="form-select" id="userRole" name="userRole" required>
                                    <option value="" selected>Select User Role</option>
                                    <option value="chef">Chef</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary text-center">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUserLabel">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="container-sm">
                    <div class="col">
                        <form method="post" action="functions/edit_user.php">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="name" class="form-control" id="name" name="name" placeholder="First Last"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="name@example.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="telephone" class="form-label">Telephone (Optional)</label>
                                <input type="telephone" class="form-control" id="telephone" name="telephone"
                                    placeholder="No Data">
                            </div>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio (Optional)</label>
                                <textarea class="form-control" id="bio" name="bio" rows="4"
                                    placeholder="No Data"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary text-center">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Recipe -->
    <div class="modal fade" id="addRecipe" tabindex="-1" aria-labelledby="addRecipeLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addRecipeLabel">Add Recipe</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="container-sm">
                    <div class="col">
                        <form action="functions/add_recipe.php" method="post" enctype="multipart/form-data">
                            <p><small>All fileds are mandatory</small></p>
                            <p><small>Recipe titles must be unique</small></p>
                            <br>
                            <div class="mb-3">
                                <label for="title" class="form-label">Recipe Title</label>
                                <input type="title" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="2"
                                    required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="regionFlag" class="form-label">Recipe Type</label>
                                <select class="form-select" id="regionFlag" name="regionFlag" required>
                                    <option value="" selected>Select Region</option>
                                    <option value="Local">Local</option>
                                    <option value="Continental">Continental</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ingredients" class="form-label">Ingredients</label>
                                <textarea class="form-control" id="ingredients" name="ingredients" rows="2"
                                    required></textarea>
                                <p class="form-text"><small><em>Separate ingredients with commas</em></small>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="instructions" class="form-label">Instructions</label>
                                <textarea class="form-control" id="instructions" name="instructions" rows="2"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary text-center">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add File Modal -->
    <div class="modal fade" id="addFile" tabindex="-1" aria-labelledby="addFileLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addFileLabel">Upload Attachment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/upload_file.php" method="post" enctype="multipart/form-data">
                        <p><small>Select an image to upload</small></p>
                        <div class="mb-3">
                            <!-- Hidden field for title -->
                            <input type="hidden" id="title" name="title" value="" required>
                            <!-- File input -->
                            <input class="form-control" type="file" id="formFile" name="fileToUpload" required>
                            <p class="form-text"><small><em>Supported file types: JPG, JPEG, PNG, GIF, and
                                        PDF</em></small></p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Recipe -->
    <div class="modal fade" id="editRecipe" tabindex="-1" aria-labelledby="editRecipeLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editRecipeLabel">Edit Recipe</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="container-sm">
                    <div class="col">
                        <form action="functions/admin_edit_recipe.php" method="post" enctype="multipart/form-data">
                            <p><small>All fileds are mandatory</small></p>
                            <p><small>You can no longer edit the recipe title</small></p>
                            <br>
                            <div class="mb-3">
                                <label for="title" class="form-label">Recipe Title</label>
                                <input type="title" class="form-control disabledInput" id="title" name="title" readonly
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="2"
                                    required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="regionFlag" class="form-label">Recipe Type</label>
                                <select class="form-select" id="regionFlag" name="regionFlag" required>
                                    <option value="Local">Local</option>
                                    <option value="Continental">Continental</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ingredients" class="form-label">Ingredients</label>
                                <textarea class="form-control" id="ingredients" name="ingredients" rows="2"
                                    required></textarea>
                                <p class="form-text"><small><em>Separate ingredients with commas</em></small>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="instructions" class="form-label">Instructions</label>
                                <textarea class="form-control" id="instructions" name="instructions" rows="2"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary text-center">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var editUserButtons = document.querySelectorAll('[id^="editUserBtn"]');
        editUserButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                // Retrieve data attributes from the button
                var name = event.currentTarget.getAttribute('data-user-name');
                var email = event.currentTarget.getAttribute('data-user-email');
                var telephone = event.currentTarget.getAttribute('data-user-telephone');
                var bio = event.currentTarget.getAttribute('data-user-bio');

                // Populate the modal fields with the retrieved data
                var modalNameInput = document.querySelector(
                    '#editUser input[name="name"]');
                var modalEmailInput = document.querySelector(
                    '#editUser input[name="email"]');
                var modalTelephoneSelect = document.querySelector(
                    '#editUser input[name="telephone"]');
                var modalBioTextarea = document.querySelector(
                    '#editUser textarea[name="bio"]');

                if (modalNameInput) modalNameInput.value = decodeURIComponent(name);
                if (modalEmailInput) modalEmailInput.value = decodeURIComponent(email);
                if (modalTelephoneSelect) modalTelephoneSelect.value = decodeURIComponent(
                    telephone);
                if (modalBioTextarea) modalBioTextarea.value =
                    decodeURIComponent(bio);
            });
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // If you have multiple upload buttons, attach the event listener to all of them
        var uploadButtons = document.querySelectorAll(
            '[id^="uploadFileBtn"]'
        ); // This selects all buttons that have an id starting with 'uploadFile'
        uploadButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                var title = event.currentTarget.getAttribute(
                    'data-recipe-title'); // Get the recipe title from the button
                var modalInput = document.querySelector(
                    '#addFile input[name="title"]'); // Select the input in the modal
                if (modalInput) {
                    modalInput.value = decodeURIComponent(
                        title); // Set the value of the input to the title, decoding it
                }
            });
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('[id^="editRecipeBtn"]');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                // Retrieve data attributes from the button
                var title = event.currentTarget.getAttribute('data-recipe-title');
                var description = event.currentTarget.getAttribute(
                    'data-recipe-description');
                var regionFlag = event.currentTarget.getAttribute(
                    'data-recipe-regionFlag');
                var ingredients = event.currentTarget.getAttribute(
                    'data-recipe-ingredients');
                var instructions = event.currentTarget.getAttribute(
                    'data-recipe-instructions');

                // Populate the modal fields with the retrieved data
                var modalTitleInput = document.querySelector(
                    '#editRecipe input[name="title"]');
                var modalDescriptionInput = document.querySelector(
                    '#editRecipe textarea[name="description"]');
                var modalRegionFlagSelect = document.querySelector(
                    '#editRecipe select[name="regionFlag"]');
                var modalIngredientsTextarea = document.querySelector(
                    '#editRecipe textarea[name="ingredients"]');
                var modalInstructionsTextarea = document.querySelector(
                    '#editRecipe textarea[name="instructions"]');

                if (modalTitleInput) modalTitleInput.value = decodeURIComponent(title);
                if (modalDescriptionInput) modalDescriptionInput.value =
                    decodeURIComponent(
                        description);
                if (modalRegionFlagSelect) modalRegionFlagSelect.value =
                    decodeURIComponent(
                        regionFlag);
                if (modalIngredientsTextarea) modalIngredientsTextarea.value =
                    decodeURIComponent(ingredients);
                if (modalInstructionsTextarea) modalInstructionsTextarea.value =
                    decodeURIComponent(instructions).replace(/\\r\\n/g, '\n');

            });
        });
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const errorMessage = urlParams.get('error');
        if (errorMessage) {
            alert(errorMessage);
        }
    });
    </script>
    <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    echo "<script>alert('" . addslashes($_SESSION['message']) . "');</script>";
    // Clear the message to prevent it from being displayed on refresh or navigation
    unset($_SESSION['message']);
}
?>
</main>