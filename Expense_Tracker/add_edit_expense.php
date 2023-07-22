<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];

if (isset($_GET['expense_id'])) {
    $update = 1;
    $expense_id = $_GET['expense_id'];
    $expenseInfo = get_info("expenses", $expense_id);
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
    <title>Add/Edit Expense</title>
    <?php include './top_scripts.php'; ?>
</head>
<body>
    <?php include './Includes/header.php'; ?>

    <section class="features7 cid-sENIyiRsb8" id="features08-3" style="min-height: 500px;">
        <div class="container">
            <div class="mbr-section-head pb-5">
                <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>Add Expense</strong>
                </h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12 mx-auto mbr-form form-col md-pb">
                    <div class="form-wrap" data-form-type="formoid">
                        <form action="process_add_expense.php" method="POST" class="mbr-form form-with-styler col-lg-6 mx-auto" data-form-title="Form Name">
                            <input type="hidden" name="update" value="<?= $update ?>"/>
                            <?php
                            if ($update) {
                                ?>
                                <input type="hidden" name="expense_id" value="<?= $expense_id ?>"/>
                                <?php
                            }
                            ?>
                            <div class="dragArea form-row">
                                <div class="col-sm-12 form-group">
                                    <input type="number" name="expense[amount_pid]" placeholder="Amount" value="<?php echo $update ? $expenseInfo['amount_pid'] : ""; ?>" class="form-control display-7" required="required"/>
                                </div>
                                <div style="clear: both"></div><br/>
                                <div class="col-sm-12 form-group">
                                    <textarea rows="6" name="expense[description]" placeholder="Description" class="form-control display-7" required="required"><?php echo $update ? $expenseInfo['description'] : ""; ?></textarea>
                                </div>
                                <div style="clear: both"></div><br/>
                                <div class="col-sm-12 form-group">
                                    <select class="form-control" name="expense[category_id]">
                                        <option value="0">--SELECT CATEGORY--</option>
                                        <?php
                                        foreach ($categories as $category) {
                                            ?>
                                            <option <?php if ($update && $expenseInfo['category_id'] == $category['id']) { ?>selected="selected"<?php } ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div style="clear: both"></div><br/>

                                <div class="mbr-section-btn">
                                    <button style="display: inline-block;" type="submit" class="btn btn-sm btn-secondary display-7">Save</button>
                                    <a style="display: inline-block; margin-left: 20px;" href="manage_expenses.php" class="btn btn-sm btn-secondary display-7">Back</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <?php include './Includes/footer.php'; ?> -->
    <?php include './bottom_scripts.php'; ?>
    <script>
        $(document).ready(function () {

        });
    </script>
</body>
</html>
