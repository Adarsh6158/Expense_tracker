<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];

if (isset($_GET['category_id'])) {
    $update = 1;
    $category_id = $_GET['category_id'];
    $categoryInfo = get_info("categories", $category_id);
} else {
    $update = 0;
}

$categories_query = $db->query("SELECT * FROM categories");
$categories = array(); // Initialize an empty array to store the categories

while ($category = $categories_query->fetch_assoc()) {
    $categories[] = $category; // Append each row to the $categories array
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $update ? 'Edit' : 'Add'; ?> Category</title>
    <?php include './top_scripts.php'; ?>
</head>
<body>
    <?php include './Includes/header.php'; ?>

    <section class="features7 cid-sENIyiRsb8" id="features08-3" style="min-height: 500px;">
        <div class="container">
            <div class="mbr-section-head pb-5">
                <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong><?php echo $update ? 'Edit' : 'Add'; ?> Category</strong>
                </h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12 mx-auto mbr-form form-col md-pb">
                    <div class="form-wrap" data-form-type="formoid">
                        <form action="process_add_category.php" method="POST" class="mbr-form form-with-styler col-lg-6 mx-auto" data-form-title="Form Name">
                            <input type="hidden" name="update" value="<?= $update ?>"/>
                            <?php
                            if ($update) {
                                ?>
                                <input type="hidden" name="category_id" value="<?= $category_id ?>"/>
                                <?php
                            }
                            ?>
                            <div class="dragArea form-row">
                                <div class="col-sm-12 form-group">
                                    <input type="text" name="category[name]" placeholder="Name" value="<?php echo $update ? $categoryInfo['name'] : ""; ?>" class="form-control display-7" required="required"/>
                                </div>
                                <!-- Other category fields... -->
                                <div class="mbr-section-btn">
                                    <button style="display: inline-block;" type="submit" class="btn btn-sm btn-secondary display-7">Save Category</button>
                                    <a style="display: inline-block; margin-left: 20px;" href="manage_categories.php" class="btn btn-sm btn-secondary display-7">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include './bottom_scripts.php'; ?>
    <script>
        $(document).ready(function () {

        });
    </script>
</body>
</html>
