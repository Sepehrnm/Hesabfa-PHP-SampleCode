<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
</head>

<nav>
    <ul>
        <li>
            <img style="width: 40px;height: 40px" src="../assets/hesabfaIcon.png" alt="hesabfaIcon">
            <img style="width: 70px;height: 60px" src="../assets/hesabfa-logo.png" alt="logo">
        </li>

        <li class="home-list">
            <a href="../index.php">خانه</a>
        </li>

        <li class="home-list">
            <a href="../Errors/errors.php">جدول کدهای خطا</a>
        </li>

        <li class="dropdown">
            <button class="dropbtn">متد های کالاها و خدمات</button>
            <div class="dropdown-content">
                <a href="../Item/getProduct.php">دریافت</a>
                <a href="../Item/saveProduct.php">ذخیره</a>
                <a href="../Item/getProductByBarcode.php">دریافت از طریق بارکد</a>
                <a href="../Item/getProductById.php">دریافت از طریق Id</a>
                <a href="../Item/products.php">دریافت لیست</a>
                <a href="../Item/deleteProduct.php">حذف</a>
                <a href="../Item/getQuantity.php">لیست موجودی کالاها</a>
                <a href="../Item/updateOpeningQuantity.php">به روز رسانی موجودی اول دوره کالاها</a>
            </div>
        </li>

        <li class="dropdown">
            <button class="dropbtn">متد های فاکتور</button>
            <div class="dropdown-content">
                <a href="../Invoice/saveInvoice.php">ذخیره فاکتور</a>
                <a href="../Invoice/deleteInvoice.php">حذف فاکتور</a>
                <a href="../Invoice/getInvoices.php">دریافت لیست</a>
                <a href="../Invoice/getInvoice.php">دریافت فاکتور</a>
                <a href="../Invoice/savePayment.php"> ثبت دریافت و پرداخت فاکتور</a>
                <a href="../Invoice/getInvoiceById.php">دریافت از طریق Id</a>
                <a href="../Invoice/getOnlineInvoiceUrl.php">دریافت URL فاکتور آنلاین</a>
                <a href="../Invoice/saveWarehouseReceipt.php">ذخیره حواله انبار</a>
            </div>
        </li>

        <li class="dropdown">
            <button class="dropbtn">متد های اشخاص</button>
            <div class="dropdown-content">
                <a href="../Contact/getContact.php">دریافت</a>
                <a href="../Contact/getContacts.php">دریافت لیست</a>
                <a href="../Contact/getContactById.php">دریافت از طریق Id</a>
                <a href="../Contact/saveContact.php">ذخیره</a>
                <a href="../Contact/deleteContact.php">حذف</a>
                <a href="../Contact/getContactLink.php">لینک کارت حساب</a>
            </div>
        </li>

        <li class="dropdown">
            <button class="dropbtn">متد های دریافت و پرداخت</button>
            <div class="dropdown-content">
                <a href="../Receipt/getReceipts.php">نمایش لیست رسیدهای دریافت یا پرداخت</a>
                <a href="../Receipt/getReceipt.php">دریافت رسید دریافت یا پرداخت</a>
                <a href="../Receipt/saveReceipt.php">ذخیره رسید</a>
                <a href="../Receipt/deleteReceipt.php">حذف رسید</a>
            </div>
        </li>

        <li class="dropdown">
            <button class="dropbtn">متد های رسید و حواله انبار</button>
            <div class="dropdown-content">
                <a href="../Warehouse/getWarehouseReceipt.php">دریافت</a>
                <a href="../Warehouse/getWarehouseReceiptById.php">دریافت از طریق ID</a>
                <a href="../Warehouse/getWarehouseReceipts.php">دریافت لیست</a>
                <a href="../Warehouse/saveWarehouseReceipt.php">ذخیره</a>
                <a href="../Warehouse/deleteWarehouseReceipt.php">حذف</a>
            </div>
        </li>

        <li class="dropdown">
            <button class="dropbtn">متد های ثبت سند حسابداری</button>
            <div class="dropdown-content">
                <a href="../Accounting/getDocument.php">دریافت</a>
                <a href="../Accounting/saveDocument.php">ذخیره</a>
                <a href="../Accounting/getDocuments.php">دریافت لیست</a>
                <a href="../Accounting/deleteDocument.php">حذف سند</a>
            </div>
        </li>

        <li class="dropdown">
            <button class="dropbtn">سایر متدها</button>
            <div class="dropdown-content">
                <a href="../Setting/getChanges.php">دریافت آخرین تغییرات</a>
                <a href="../Setting/getFiscalYears.php">دریافت لیست سال مالی</a>
                <a href="../Setting/getBanks.php">دریافت لیست بانک ها</a>
                <a href="../Setting/getCashes.php">دریافت لیست صندوق ها</a>
                <a href="../Setting/getPettyCashes.php">دریافت لیست تنخواه گردان ها</a>
                <a href="../Setting/getCurrency.php">دریافت واحد پول</a>
                <a href="../Setting/getWarehouses.php">دریافت لیست انبار ها</a>
                <a href="../Setting/getProductCategories.php">دریافت لیست دسته بندی کالا ها</a>
                <a href="../Setting/getServiceCategories.php">دریافت لیست دسته بندی خدمات</a>
                <a href="../Setting/getContactCategories.php">دریافت لیست دسته بندی اشخاص</a>
                <a href="../Setting/getFiscalYear.php">دریافت اطلاعات سال مالی جاری</a>
                <a href="../Setting/getProjects.php">دریافت لیست پروژه ها</a>
                <a href="../Setting/getSalesmen.php">دریافت لیست فروشنده ها</a>
                <a href="../Setting/getCurrencyTable.php">دریافت جدول نرخ برابری ارزها</a>
                <a href="../Setting/setCurrencyTable.php">تنظیم جدول نرخ برابری ارزها</a>
                <a href="../Setting/getAccounts.php">دریافت جدول حساب ها</a>
                <a href="../Setting/getBusinessInfo.php">دریافت اطلاعات کسب و کار</a>
            </div>
        </li>

        <li class="dropdown">
            <button class="dropbtn">متد های دریافت گزارش</button>
            <div class="dropdown-content">
                <a href="../Report/balancesheet.php">گزارش ترازنامه</a>
                <a href="../Report/debtorscreditors.php">گزارش بدهکاران و بستانکاران</a>
                <a href="../Report/profitAndLossStatement.php"> گزارش صورت سود و زیان</a>
                <a href="../Report/reportInventory.php">گزارش موجودی کالا</a>
                <a href="../Report/trialBalance.php">گزارش تراز آزمایشی</a>
                <a href="../Report/trialBalanceItems.php">گزارش آیتم های تفضیلی تراز آزمایشی</a>
            </div>
        </li>
    </ul>
</nav>
<script type='text/javascript'>
    function init() {
        $('button.dropbtn').on('click', (e) => {
            $(".dropdown-content").slideUp();
            $(e.target).next().stop().slideToggle();
        });
    }

    $( document ).ready(() => {
        init();
    });

    var path = window.location.href.substring(window.location.href.lastIndexOf('API') + 4);
    $('a[href="../' + path + '"]').parent().slideDown();
</script>