function initializeReceiptPage(data) {
    $('#gridContainer').dxDataGrid({
        dataSource: [data],
        keyExpr: 'Id',
        rtlEnabled: true,
        responsive: true,
        columnHidingEnabled: true,
        filterRow: {
            visible: true
        },
        paging: {
            pageSize: 10,
        },
        focusedRowEnabled: true,
        showColumnLines: true,
        showRowLines: true,
        rowAlternationEnabled: true,
        showBorders: true,
        headerFilter: {
            visible: true,
        },
        groupPanel: {
            visible: true,
        },
        columns: [
            {
                dataField: "Id",
                caption: "ID",
            },
            {
                dataField: "Date",
                caption: "تاریخ حواله",
            },
            {
                dataField: "Delivery",
                caption: "تحویل",
            },
            {
                dataField: "InvoiceNumber",
                caption: "شماره فاکتور",
            },
            {
                dataField: "Project",
                caption: "پروژه",
            },
            {
                dataField: "Receiving",
                caption: "دریافت شده (رسید ورود به انبار یا حواله خروج از انبار)",
            },
            {
                dataField: "Notes",
                caption: "یادداشت و توضیحات",
            },
            {
                dataField: "DestinationWarehouseCode",
                caption: "کد حواله انتقال",
            },
            {
                dataField: "InvoiceType",
                caption: "نوع فاکتور",
            },
            {
                dataField: "Items",
                caption: "آیتم های موجود",
                cellTemplate: function (container, options) {
                    var content = options.data.Items.map(item => `<div> کد کالا: ${item.ItemCode} ارجاع: ${item.Reference} توضیحات: ${item.Notes}  موجودی: ${item.Quantity}</div>`).join("<br>");
                    $('<div>').html(content).css("white-space", "pre-wrap").appendTo(container);
                }
            },
        ],
    });
}

function initializeReceiptsListPage(data) {
    $('#gridContainer').dxDataGrid({
        dataSource: data,
        keyExpr: 'Number',
        rtlEnabled: true,
        responsive: true,
        columnHidingEnabled: true,
        filterRow: {
            visible: true
        },
        paging: {
            pageSize: 10,
        },
        focusedRowEnabled: true,
        showColumnLines: true,
        showRowLines: true,
        rowAlternationEnabled: true,
        showBorders: true,
        headerFilter: {
            visible: true,
        },
        groupPanel: {
            visible: true,
        },
    });
}

function initializeGetTrialBalanceListPage(data) {
    $('#trialBalanceGridContainer').dxDataGrid({
        dataSource: JSON.parse(data),
        keyExpr: 'Debit',
        rtlEnabled: true,
        columnMinWidth: 150,
        filterRow: {
            visible: true
        },
        paging: {
            pageSize: 25,
        },
        columns: [
            { caption: "نام حساب", dataField: "Account.Name" },
            { caption: "مسیر حساب", dataField: "Account.Path" },
            {
                caption: "نوع حساب", dataField: "Account.AccountType", lookup: {
                    dataSource: [
                        { id: '0', text: 'عمومی' },
                        { id: '1', text: 'صندوق' },
                        { id: '2', text: 'تنخواه گردان' },
                        { id: '3', text: 'بانک' },
                        { id: '4', text: 'حساب های دریافتنی' },
                        { id: '5', text: 'اسناد دریافتنی' },
                        { id: '6', text: 'اسناد در جریان وصول' },
                        { id: '7', text: 'موجودی کالا' },
                        { id: '8', text: 'مالیات بر ارزش افزوده خرید' },
                        { id: '9', text: 'حساب های پرداختنی' },
                        { id: '10', text: 'اسناد پرداختنی' },
                        { id: '11', text: 'مالیات بر ارزش افزوده فروش' },
                        { id: '12', text: 'مالیات بر درآمد پرداختنی' },
                        { id: '40', text: 'ذخیره مالیات بر درآمد پرداختنی' },
                        { id: '13', text: 'سرمایه اولیه' },
                        { id: '14', text: 'افزایش یا کاهش سرمایه' },
                        { id: '15', text: 'اندوخته قانونی' },
                        { id: '16', text: 'برداشت ها' },
                        { id: '17', text: 'سهم سود و زیان' },
                        { id: '18', text: 'سود یا زیان انباشته (سنواتی)' },
                        { id: '19', text: 'بهای تمام شده کالای فروخته شده / خرید' },
                        { id: '20', text: 'برگشت از خرید' },
                        { id: '21', text: 'تخفیفات نقدی خرید' },
                        { id: '22', text: 'فروش' },
                        { id: '23', text: 'برگشت از فروش' },
                        { id: '24', text: 'تخفیفات نقدی فروش' },
                        { id: '25', text: 'درآمد حاصل از فروش خدمات' },
                        { id: '26', text: 'برگشت از خرید خدمات' },
                        { id: '27', text: 'درآمد اضافه کالا' },
                        { id: '28', text: 'درآمد حمل کالا' },
                        { id: '29', text: 'برگشت از فروش خدمات' },
                        { id: '30', text: 'خرید خدمات' },
                        { id: '31', text: 'هزینه حمل کالا' },
                        { id: '32', text: 'هزینه کسری و ضایعات کالا' },
                        { id: '33', text: 'کارمزد خدمات بانکی' },
                        { id: '34', text: 'کنترل کسری و اضافه کالا' },
                        { id: '35', text: 'خلاصه سود و زیان' },
                        { id: '36', text: 'درآمد تسعیر ارز' },
                        { id: '37', text: 'هزینه تسعیر ارز' },
                    ],
                    valueExpr: 'id',
                    displayExpr: 'text'
                }
            },
            {
                caption: "نوع حساب اصلی", dataField: "Account.MainAccountType", lookup: {
                    dataSource: [
                        { id: '1', text: 'دارایی ها' },
                        { id: '2', text: 'بدهی ها' },
                        { id: '3', text: 'حقوق صاحبان سهام' },
                        { id: '4', text: 'بهای تمام شده کالای فروخته شده / خرید' },
                        { id: '5', text: 'فروش' },
                        { id: '6', text: 'درآمد' },
                        { id: '7', text: 'هزینه ها' },
                        { id: '8', text: 'سایر حساب ها' },
                    ],
                    valueExpr: 'id',
                    displayExpr: 'text'
                }
            },
            { caption: "گردش بدهکار", dataField: "Debit" },
            { caption: "گردش بستانکار", dataField: "Credit" },
            { caption: "تراز حساب", dataField: "Balance" },
            { caption: "ماهیت حساب", dataField: "BalanceType", lookup: {
                    dataSource: [
                        { id: '0', text: 'بدهکار' },
                        { id: '1', text: 'بستانکار' }
                    ],
                    valueExpr: 'id',
                    displayExpr: 'text'
                }
            },
            { caption: "تراز افتتاحیه - بدهکار", dataField: "OpeningDebit" },
            { caption: "تراز افتتاحیه - بستانکار", dataField: "OpeningCredit" },
            { caption: "مانده از قبل - بدهکار", dataField: "RemainingDebit" },
            { caption: "مانده از قبل - بستانکار", dataField: "RemainingCredit" },
        ],
        focusedRowEnabled: true,
        showColumnLines: true,
        showRowLines: true,
        rowAlternationEnabled: true,
        showBorders: true,
        headerFilter: {
            visible: true,
        },
        groupPanel: {
            visible: true,
        },
    });
}

function formatBalanceSheetData(data, ret, id, parentId) {
    for (const d of data) {
        d.id = id++;
        d.parentId = parentId;
        ret.push(d);
        id = formatBalanceSheetData(d.Children, ret, id, d.id);
    }
    return id;
}

function initializeBalancesheetPage(data) {
    data = JSON.parse(data);
    var list = [];

    formatBalanceSheetData(data.Accounts, list, 1, 0);

    $('#simple-treeview').dxTreeList({
        dataSource: list,
        keyExpr: 'id',
        parentIdExpr: 'parentId',
        rtlEnabled: true,
        columns: [
            {
                dataField: 'Account',
                caption: 'حساب',
                cellTemplate: function (container, options) {
                    $('<div>').text(options.data.Account.Name).appendTo(container);
                }
            },
            {
                dataField: 'Balance',
                caption: 'تراز حساب'
            },
            {
                dataField: 'Credit',
                caption: 'گردش بستانکار'
            },
            {
                dataField: 'Debit',
                caption: 'گردش بدهکار'
            },
            {
                dataField: 'TotalCredit',
                caption: 'تراز - بستانکار'
            },
            {
                dataField: 'TotalDebit',
                caption: 'تراز - بدهکار'
            },
            {
                dataField: 'TotalBalance',
                caption: 'تراز کل حساب'
            },
        ]
    });
    $("#assets").text("سرجمع دارایی ها:" + "\t \t" + data.Assets);
    $("#equity").text("بدهی ها:" + "\t \t" + data.Equity);
    $("#liabilities").text("حقوق صاحبان سهام:" + "\t \t" + data.Liabilities);
    $("#profitOrLoss").text("سود و زیان:" + "\t \t" + data.ProfitOrLoss);
}

function initializeReceiptsByIDListPage(data) {
    $('#gridContainer').dxDataGrid({
        dataSource: data,
        keyExpr: 'Number',
        rtlEnabled: true,
        responsive: true,
        columnHidingEnabled: true,
        paging: {
            pageSize: 10,
        },
        focusedRowEnabled: true,
        showColumnLines: true,
        showRowLines: true,
        rowAlternationEnabled: true,
        showBorders: true,
        groupPanel: {
            visible: true,
        },
        columns: [
            {
                dataField: "Id",
                caption: "ID",
            },
            {
                dataField: "Date",
                caption: "تاریخ حواله",
            },
            {
                dataField: "Delivery",
                caption: "تحویل",
            },
            {
                dataField: "InvoiceNumber",
                caption: "شماره فاکتور",
            },
            {
                dataField: "Project",
                caption: "پروژه",
            },
            {
                dataField: "Receiving",
                caption: "دریافت شده (رسید ورود به انبار یا حواله خروج از انبار)",
            },
            {
                dataField: "Notes",
                caption: "یادداشت و توضیحات",
            },
            {
                dataField: "DestinationWarehouseCode",
                caption: "کد حواله انتقال",
            },
            {
                dataField: "InvoiceType",
                caption: "نوع فاکتور",
            },
            {
                dataField: "Items",
                caption: "آیتم های موجود",
                cellTemplate: function (container, options) {
                    var content = options.data.Items.map(item => `<div> کد کالا: ${item.ItemCode} ارجاع: ${item.Reference} توضیحات: ${item.Notes}  موجودی: ${item.Quantity}</div>`).join("<br>");
                    $('<div>').html(content).css("white-space", "pre-wrap").appendTo(container);
                }
            },
        ],
    });
}