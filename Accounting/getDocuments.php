<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();

global $result, $totalCount, $rpp, $i, $Skip, $Take;

$Skip = 0;
$Take = 10;

$query = array(
    "SortBy"=> "Date",
    "SortAsce"=> true,
    "Take"=> $Take,
    "Skip"=> $Skip
);

$data = array(
    "queryInfo" => $query
);

$result = $api->getDocuments($data);
$totalCount = ($result->{"Result"}->TotalCount);


if($totalCount % $Take != 0) {
    $totalCount += $Take;
}

if(isset($_POST["buttonSubmit"])) {
    for($j=0 ; $j<=(($totalCount)/$Take) ; $j++) {
        if(isset($_POST["buttonSubmit"][$j])) {
            $value = $_POST["buttonInput"][$j];
            $rpp = ($value * $Take);
            $i = ($rpp - $Take);
            $query = array(
                "SortBy" => "Date",
                "SortAsce" => true,
                "Take" => $rpp,
                "Skip" => $i
            );

            $data = array(
                "queryInfo" => $query
            );

            $result = $api->getDocuments($data);
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت لیست</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>

<?php if($result) { $documents = $result->{'Result'}->{'List'};

?>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <h3>
                دریافت لیست سند حسابداری
            </h3>
            <br>
            <table class="table table-striped table-hover">
                <th>ID</th>
                <th>شماره سند</th>
                <th>ارجاع</th>
                <th>تاریخ</th>
                <th>توضیحات</th>
                <th>پروژه</th>
                <th>بدهکار</th>
                <th>بستانکار</th>
                <th><a target="_blank" href="https://hesabfa.com/help/api/TypesTable#doc-status">وضعیت سند</a></th>
                <th>تراکنش ها</th>
                <?php
                $i = $Skip;
                $rpp = $Take;
                for ($j=$i ; $j < $rpp ; $j++) {
                    if(isset($documents[$j]->Id)) {
                        ?>
                        <tr>
                            <td><?php echo $documents[$j]->Id; ?></td>
                            <td><?php echo $documents[$j]->Number; ?></td>
                            <td><?php echo $documents[$j]->Reference; ?></td>
                            <td><?php echo $documents[$j]->Date; ?></td>
                            <td><?php echo $documents[$j]->Description; ?></td>
                            <td><?php echo $documents[$j]->Project; ?></td>
                            <td><?php echo $documents[$j]->Debit; ?></td>
                            <td><?php echo $documents[$j]->Credit; ?></td>
                            <td><?php echo $documents[$j]->Status; ?></td>
                            <td><?php foreach ($documents[$j]->Transactions as $transaction) {
                                echo $transaction;
                            }?></td>

                        </tr>
                    <?php  } } } else {echo "چیزی برای نمایش نیست";}?>
            </table>
            <form method="post">
                <div class="button-container">
                    <?php
                    for($z=1 ; $z<=($totalCount/$Take) ; $z++) {
                        ?>
                        <button type="submit" name="buttonSubmit[<?php echo $z;?>]" class="buttonInput btn btn-primary" value="<?php echo $z;?>"><?php echo $z;?>
                            <input name="buttonInput[<?php echo $z;?>]" type="hidden" value="<?php echo $z;?>" />
                        </button>
                    <?php  } ?>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
