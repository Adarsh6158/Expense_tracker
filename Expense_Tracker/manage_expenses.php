<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else {
    $limit = 10;
}

$sql = "SELECT count(id) FROM expenses WHERE user_id = $user_id ";
if (isset($params['filter'])) {
    if (isset($params['filter_category_id']) && !empty($params['filter_category_id'])) {
        $filter_category = $params['filter_category_id'];
        $sql .= " AND category_id = $filter_category";
    }
}

$result = mysqli_query($db, $sql);
$total_entries = mysqli_fetch_row($result)[0];

if ($total_entries < $limit) {
    $results = $total_entries;
    $offset = ($page - 1) * $limit;
} else {
    $offset = ($page - 1) * $limit;
    $results = $offset + $limit;

    if ($page * $limit > $total_entries) {
        $results = $total_entries;
    } else {
        $results = $offset + $limit;
    }
}

$total_pages = intval($total_entries / $limit) + 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT e.*, c.name as category_name FROM expenses e LEFT JOIN categories c ON e.category_id = c.id WHERE user_id = $user_id ";
if (isset($params['filter'])) {
    if (isset($params['filter_category_id']) && !empty($params['filter_category_id'])) {
        $filter_category = $params['filter_category_id'];
        $sql .= " AND e.category_id = $filter_category";
    }
}
$sql .= " ORDER BY datetime_added DESC LIMIT $offset, $limit ";

$result = mysqli_query($db, $sql);

// Fetch the expenses as an associative array
$expenses = array();
while ($row = mysqli_fetch_assoc($result)) {
    $expenses[] = $row;
}

$result = mysqli_query($db, $sql);

// Fetch the categories as an associative array
$categories = array();
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Expenses</title>
    <?php include './top_scripts.php'; ?>
</head>
<body>
    <?php include './Includes/header.php'; ?>

    <section class="features7 cid-sENIyiRsb8" id="features08-3" style="min-height: 500px;">
        <div class="container">
            <div class="mbr-section-head pb-5">
                <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>MANAGE EXPENSES</strong>
                </h4>
            </div>
            <div class="row ">
                <div data-form-type="formoid" style="text-align: left">
                    <form action="manage_expenses.php" method="GET" class="mbr-form">
                        <input type="hidden" name="filter" value="1"/>
                        <div id="filter_wrapper">
                            <div class="field_wrapper">
                                <label>Filter By Category</label>
                                <select class="form-control" name="filter_category_id">
                                    <option value="0">--SELECT CATEGORY--</option>
                                    <?php
                                    foreach ($categories as $category) {
                                        ?><option <?php if (isset($params['filter']) && $params['filter_category_id'] == $category['id']) { ?>selected="selected"<?php } ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option><?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <br/>
                            <div class="field_wrapper">
                                <button style="display: inline-block" type="submit" id="btn_search" class="btn btn-sm btn-primary btn_extra_small">Search</button>
                                <a style="display: inline-block" href="manage_expenses.php" class="btn btn-sm btn-primary btn_extra_small">Clear Filters</a>
                            </div>
                            <br/>
                        </div>
                    </form>
                </div>
                <?php
                if (!empty($expenses)) {
                    ?><table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Date Time</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($expenses as $expense) {
                                ?><tr>
                                    <td><?= $expense['id'] ?></td>
                                    <td><?= $expense['description'] ?></td>
                                    <td><?= $expense['amount_pid'] ?></td>
                                    <td><?= $expense['category_name'] ?></td>
                                    <td><?= date('Y-m-d H:i:s', strtotime($expense['datetime_added'])) ?></td>
                                    <td><a href="add_edit_expense.php?expense_id=<?= $expense['id'] ?>" class="btn btn-sm btn-primary btn_extra_small">Edit</a></td>
                                    <td><a onclick="return confirm('Are you sure you want to delete this expense?')" href="delete_expense.php?expense_id=<?= $expense['id'] ?>" class="btn btn-sm btn-primary btn_extra_small">Delete</a></td>
                                </tr><?php
                            }
                            ?>
                        </tbody>
                    </table><?php
                } else {
                    ?><h4>No expenses added yet</h4><?php
                }
                ?>
                <div class="pageing">
                    <div class="total_info">Results <?= $offset + 1 ?> - <?= $results ?> of <?= $total_entries ?></div>
                    <div class="pages_wrapper">
                        <?php
                        if ($page != 1) {

                            ?><a href="manage_expenses.php?page=1&limit=<?= $limit ?>"><span class="nmb_left">First</span><span class="nmb_right"></span></a>
                            <a href="manage_expenses.php?page=<?= ($page - 1) ?>&limit=<?= $limit ?>"><span class="nmb_left">Previous</span><span class="nmb_right"></span></a><?php
                        } else {
                            ?>
                            <!-- First page link -->
                            <div class="none"><span class="nmb_left">First</span><span class="nmb_right"></span></div>
                            <!-- Previous page link -->
                            <div class="none"><span class="nmb_left">Previous</span><span class="nmb_right"></span></div>
                            <?php
                        }

                        if ($total_entries > $limit) {
                            if ($page >= ($total_pages - 2) && $total_pages > 2) {
                                for ($p = ($total_pages - 2); $p <= $total_pages; $p++) {

                                    ?><a href="manage_expenses.php?page=<?= $p ?>&limit=<?= $limit ?>"><span class="nmb_left"><?= $p ?></span><span class="nmb_right"></span></a><?php
                                }
                            } else if ($page > 3) {
                                for ($p = ($page - 2); $p <= ($page + 2); $p++) {

                                    ?><a href="manage_expenses.php?page=<?= $p ?>&limit=<?= $limit ?>"><span class="nmb_left"><?= $p ?></span><span class="nmb_right"></span></a><?php
                                }
                            } else {
                                if ($total_pages > 2) {
                                    $max_page = 5;
                                } else {
                                    $max_page = $total_pages;
                                }
                                for ($p = 1; $p <= $max_page; $p++) {

                                    ?><a href="manage_expenses.php?page=<?= $p ?>&limit=<?= $limit ?>"><span class="nmb_left"><?= $p ?></span><span class="nmb_right"></span></a><?php
                                }
                            }

                            if ($page != $total_pages) {

                                ?><a href="manage_expenses.php?page=<?= ($page + 1) ?>&limit=<?= $limit ?>"><span class="nmb_left">Next</span><span class="nmb_right"></span></a>
                                <a href="manage_expenses.php?page=<?= $total_pages ?>&limit=<?= $limit ?>"><span class="nmb_left">Last</span><span class="nmb_right"></span></a><?php
                            } else {
                                ?>
                                <!-- First page link -->
                                <div class="none"><span class="nmb_left">Next</span><span class="nmb_right"></span></div>
                                <!-- Previous page link -->
                                <div class="none"><span class="nmb_left">Last</span><span class="nmb_right"></span></div>
                                <?php
                            }
                        }
                        ?>
                        <div style="clear: both"></div>
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
            <a href="add_edit_expense.php" class="btn btn-primary">Add Expense</a>
        </div>
    </section>
    <?php include './bottom_scripts.php'; ?>
    <script>
        $(document).ready(function () {

        });
    </script>
</body>
</html>
