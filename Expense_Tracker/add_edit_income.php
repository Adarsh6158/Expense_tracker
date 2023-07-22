<?php
include './Includes/Functions/Functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];

if(isset($params['income_id'])){
    $update = 1;
    $income_id = $params['income_id'];
    $incomeInfo = get_info("income", $income_id);
}else{
    $update = 0;
}

$income_query = $db->query("SELECT * FROM income");
$income = $income_query->fetch_all(MYSQLI_ASSOC);
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
                <strong>Add INCOME</strong></h4>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12 mx-auto mbr-form form-col md-pb">
                <div class="form-wrap" data-form-type="formoid">
                    <form action="process_add_income.php" method="POST" class="mbr-form form-with-styler col-lg-6 mx-auto"
                          data-form-title="Form Name">
                        <input type="hidden" name="update" value="<?= $update ?>"/>
                        <?php
                        if($update){
                            ?><input type="hidden" name="income_id" value="<?= $income_id ?>"/><?php
                        }
                        ?>
                        <div class="dragArea form-row">
                            <div class="col-sm-12 form-group">
                                <input type="text" name="income[name]" placeholder="Name" value="<?php echo $update ? $incomeInfo['name'] : ""; ?>"
                                       class="form-control display-7" required="required"/>
                            </div>
                            <div style="clear: both"></div><br/>
                            <div class="col-sm-12 form-group">
                                <input type="number" name="income[amount]" placeholder="Amount" value="<?php echo $update ? $incomeInfo['amount'] : ""; ?>"
                                       class="form-control display-7" required="required"/>
                            </div>
                            <div style="clear: both"></div><br/>

                            <div class="mbr-section-btn">
                                <button style="display: inline-block;" type="submit" class="btn btn-sm btn-secondary display-7">Save</button>
                                <a style="display: inline-block; margin-left: 20px;" href="income.php" class="btn btn-sm btn-secondary display-7">Back</a>
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
