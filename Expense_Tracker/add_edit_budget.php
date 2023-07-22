<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];

if (isset($_GET['budget_id'])) {
    $update = 1;
    $budget_id = $_GET['budget_id'];
    $budget = get_info("budget", $budget_id); // Changed variable name to $budget
} else {
    $update = 0;
    $budget = array(); // Initialize an empty array for a new budget
}

$budget_query = $db->query("SELECT * FROM budget WHERE user_id = $user_id");
$budgets = $budget_query->fetch_all(MYSQLI_ASSOC);

$goals_query = $db->query("SELECT * FROM goals WHERE user_id = $user_id");
$goals = $goals_query->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <?php include './top_scripts.php'; ?>
</head>
<body>

<?php include './Includes/header.php'; ?>


<section class="features7 cid-sENIyiRsb8" id="features08-3" style="min-height: 500px;">
    <div class="container">
        <div class="mbr-section-head pb-5">
            <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                <strong><?php echo $update ? 'Edit' : 'Add'; ?> BUDGET</strong>
            </h4>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12 mx-auto mbr-form form-col md-pb">
                <div class="form-wrap" data-form-type="formoid">
                    <form action="process_add_budget.php" method="POST" class="mbr-form form-with-styler col-lg-6 mx-auto"
                          data-form-title="Form Name">
                        <input type="hidden" name="update" value="<?= $update ?>"/>
                        <?php
                        if ($update) {
                            ?>
                            <input type="hidden" name="budget_id" value="<?= $budget_id ?>"/>
                            <?php
                        }
                        ?>
                        <div class="dragArea form-row">
    <div class="col-sm-12 form-group">
        <select class="form-control" name="budget[goal_id]">
            <option value="0">--SELECT GOALS--</option>
            <?php
            foreach ($goals as $gol) {
                ?>
                <option <?php if ($update && $budget['goal_id'] == $gol['goal']) { ?>selected="selected"<?php } ?>
                        value="<?= $gol['goal'] ?>"><?= $gol['goal'] ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div style="clear: both"></div><br/>
    <div class="col-sm-12 form-group">
        <!-- Update the name attribute to "budget[amount]" -->
        <input type="number" name="budget[amount]" placeholder="Amount"
               value="<?php echo $update ? $budget['amount'] : ""; ?>"
               class="form-control display-7" required="required"/>
    </div>
    <div style="clear: both"></div><br/>

                            <div class="mbr-section-btn">
                                <button style="display: inline-block;" type="submit"
                                        class="btn btn-sm btn-secondary display-7">Save
                                </button>
                                <a style="display: inline-block; margin-left: 20px;" href="budget.php"
                                   class="btn btn-sm btn-secondary display-7">Back</a>
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
