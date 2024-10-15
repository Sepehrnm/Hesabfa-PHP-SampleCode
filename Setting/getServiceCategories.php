<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();

global $result;
$result = $api->settingGetServiceCategories();
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت لیست دسته بندی خدمات</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>
<?php if($result) { $categories = $result->{"Result"}->{"Root"};

?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت لیست دسته بندی خدمات
            </h3>
            <br>
            <div id="category-name"></div>
            <?php
            $display = showCategory($categories);
            echo
                '<div class="category-div" style="font-size: 1.2rem;font-weight: bold;color: #707070;">'
                . $display .
                '</div>';
            ?>
            <?php } else {echo "چیزی برای نمایش نیست";}?>
        </div>
    </div>
</div>

<script>
    //displaying the categories properly
    $(document).ready(() => {
        var spanValue;
        var name = document.getElementById('category-name');

        $('.category-content').children('div').slideUp();

        $(".dropdown-icon").on('click', function(e) {
            e.stopPropagation();
            $(this).toggleClass("rotate");
            $(this).next().next().stop().slideToggle();

            spanValue = $(this).parent()[0].children[1].getAttribute("value");
            console.log(spanValue)
            name.innerHTML = spanValue;
        });
    });

</script>
<?php
//recursive function for displaying tree view
function showCategory( $category, $offset = 0 ) {
    $html = '<div style="padding-right: '. $offset .'rem;" class="category-content category-content-'. $offset .'">' . '<img class="dropdown-icon dropdown-level-'. $offset .'"  src="../assets/left-arrow-circle.svg" />' . '<span value="' . $category->FullPath . '" class="name-level-'. $offset .'">' . $category->Name . '</span>' . '<div>';
    if ( isset( $category->Name ) ) {
        foreach ( $category->Children as $sub_category ) {
            $html .= showCategory( $sub_category, $offset+1 );
        }
    }
    $html .= '</div></div>';

    return $html;
}
?>
</body>
</html>