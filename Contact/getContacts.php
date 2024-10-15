<?php
error_reporting(0);
    include "../API/class-api.php";
    $api = new Ssbhesabfa_Api();

    global $totalCount;
    $take = 10;
    $skip = 0;
    $query = array(
        "SortBy" => "Code",
        "SortAsec" => true,
        "Take" => $take,
        "Skip" => $skip
    );

$result = $api->getContacts($query);
$totalCount = ($result->{"Result"}->TotalCount);

if($totalCount % 10 != 0) $totalCount += 10;
if(isset($_POST["buttonSubmit"])) {
    for($j=0 ; $j<=(($totalCount)/10) ; $j++) {
        if(isset($_POST["buttonSubmit"][$j])) {
            $value = $_POST["buttonInput"][$j];
            $rpp = ($value * 10);
            $i = ($rpp - 10);
            $query = array(
                "SortBy" => "Code",
                "SortAsce" => true,
                "Take" => $rpp,
                "Skip" => $i
            );
            $result = $api->getContacts($query);
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
<?php include '../Errors/errorLog.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت لیست اشخاص
            </h3>
            <br>
            <table style="text-align: center;" class="table table-striped table-hover">
                <tr>
                    <th>ID</th>
                    <th>نام شخص</th>
                    <th>کد شخص</th>
                    <th>شرکت</th>
                    <th>کد/شناسه ملی</th>
                    <th>کد اقتصادی</th>
                    <th>وب سایت</th>
                    <th>ایمیل</th>
                    <th>Tag</th>
                </tr>
                <?php
                $i = 0;
                $rpp = 10;
                foreach ($result->{'Result'}->List as $person) {
                if($i < $rpp) {
                    ?>
                    <tr>
                        <td><?php echo($person->Id);?></td>
                        <td><?php echo($person->Name);?></td>
                        <td><?php echo($person->Code);?></td>
                        <td><?php echo($person->Company);?></td>
                        <td><?php echo($person->NationalCode); ?></td>
                        <td><?php echo($person->EconomicCode); ?></td>
                        <td><?php echo($person->Website); ?></td>
                        <td style="direction: ltr;"><?php echo($person->ContactEmail); ?></td>
                        <td><?php echo($person->Tag); ?></td>
                    </tr>
                <?php } $i++;  }?>
            </table>
            <form method="post">
                <div class="button-container">
                    <?php
                    for($z=1 ; $z<=($totalCount/10) ; $z++) {
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

