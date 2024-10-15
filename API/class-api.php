<?php
error_reporting(0);
class Ssbhesabfa_Api
{
//================================================================================================
    public function apiRequest($method, $data = array())
    {
        //Add you apikey and login token here properly
        $APIKEY = '#';
        $LOGINTOKEN = '#';

        $endpoint = 'https://api.hesabfa.com/v1/' . $method;
        $curl = curl_init();

        $body = array_merge(array(
            'apiKey' => $APIKEY,
            'loginToken' => $LOGINTOKEN,
        ), $data);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
            CURLOPT_POSTFIELDS => json_encode($body)
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($curl);

        if (curl_errno($curl)) {
            echo "CURL ERROR - " . curl_error($curl);
        } else {
            return json_decode($result);
        }

        curl_close($curl);
    }
//================================================================================================
// HESABFA FUNCTIONS

    public function getWarehouse($data)
    {
        $method = 'warehouse/get';
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getWarehouseById($data)
    {
        $method = 'warehouse/GetById';
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getWarehouseList($data)
    {
        $method = 'warehouse/GetReceipts';
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function warehouseSaveWarehouse($deleteOldReceipts, $receipt)
    {
        $method = 'warehouse/save';
        $data = array(
            'deleteOldReceipts' => (bool)$deleteOldReceipts,
            'receipt' => $receipt,
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function deleteWarehouse($data)
    {
        $method = 'warehouse/delete';
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function savePayment($data)
    {
        $method = 'invoice/savepayment';

        $data = array(
            'type' => $data['type'],
            'number' => $data['number'],
            'bankCode' => $data['bankCode'],
            'date' => $data['date'],
            'amount' => $data['amount'],
            'transactionNumber' => $data['transactionNumber'],
            'description' => $data['description'],
            'transactionFee' => $data['transactionFee'],
            'currency' => $data['currency'],
            'currencyRate' => $data['currencyRate'],
            'cashCode' => $data['cashCode'],
            'pettyCashCode' => $data['pettyCashCode'],
        );

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getProjects()
    {
        $method = 'setting/getBusinessInfo';
        $data = array();

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getContacts($query)
    {
        $method = 'contact/getcontacts';
        $data = array(
            'queryInfo' => $query
        );

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getContact($code)
    {
        $method = 'contact/get';
        $data = array(
            'code' => $code
        );

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getContactById($idList)
    {
        $method = 'contact/getById';
        $data = array(
            'idList' => $idList
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function saveContact($contact)
    {
        $method = 'contact/save';
        $data = array(
            'contact' => $contact
        );

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function contactBatchSave($contacts)
    {
        $method = 'contact/batchsave';
        $data = array(
            'contacts' => $contacts
        );

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getContactLink($data)
    {
        $method = 'contact/getContactLink';

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function deleteContact($code)
    {
        $method = 'contact/delete';
        $data = array(
            'code' => $code
        );

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function invoiceSave($invoice)
    {
        $method = 'invoice/save';
        $data = array(
            'invoice' => $invoice,
        );

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function invoiceGet($data)
    {
        $method = 'invoice/get';

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function invoiceGetById($invoiceID)
    {
        $method = 'invoice/getById';
        $data = array(
            'id' => $invoiceID,
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function invoiceGetAll($type, $query)
    {
        $method = 'invoice/getinvoices';

        $data = array(
            'type' => $type,
            'queryInfo' => ($query)
        );

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function invoiceDelete($number, $type = 0)
    {
        $method = 'invoice/delete';
        $data = array(
            'number' => $number,
            'type' => $type,
        );

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function itemsGet($query)
    {
        $method = 'item/getitems';
        $data = [
            "queryInfo" => $query
        ];
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getItem($data)
    {
        $method = 'item/get';
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function saveItem($data)
    {
        $method = 'item/save';
        $data = array(
            'item' => $data
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function productBatchSave($data)
    {
        $method = 'item/batchsave';
        $data = array(
            'items' => $data
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function UpdateOpeningQuantity($data)
    {
        $method = 'item/UpdateOpeningQuantity';
        $data = array(
            'items' => $data
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getItemByBarcode($data)
    {
        $method = 'item/getByBarcode';

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getItemById($idList)
    {
        $method = 'item/getById';
        $data = array(
            'idList' => $idList
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getDocument($number)
    {
        $method = 'document/get';
        $data = [
            "number" => $number
        ];
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getDocuments($query)
    {
        $method = 'document/getdocuments';
        $data = [
            "queryInfo" => $query["queryInfo"],
        ];
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function deleteDocument($number)
    {
        $method = 'document/delete';
        $data = [
            "number" => $number,
        ];
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function saveDocument($document)
    {
        $method = 'document/save';
        $data = array(
            "document" => $document,
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetChanges($start)
    {
        $method = 'setting/GetChanges';
        $data = array(
            'start' => $start,
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetPettyCashes()
    {
        $method = 'setting/GetPettyCashes';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getQuantity()
    {
        $method = 'item/GetQuantity';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getReceipts($data)
    {
        $method = 'receipt/getReceipts';
        $data = array(
            'type' => $data["type"],
            'queryInfo' => $data["queryInfo"]
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getReceipt($data)
    {
        $method = 'receipt/get';
        $data = array(
            'type' => $data["type"],
            'number' => $data["number"]
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function deleteReceipt($data)
    {
        $method = 'receipt/delete';
        $data = array(
            'type' => $data["type"],
            'number' => $data["number"]
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
        public function saveReceipt($data)
    {
        $method = 'receipt/save';

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetBanks()
    {
        $method = 'setting/GetBanks';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetCashes()
    {
        $method = 'setting/GetCashes';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetCurrency()
    {
        $method = 'setting/GetCurrency';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetWarehouses()
    {
        $method = 'setting/GetWarehouses';
        $data = [];
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetProductCategories()
    {
        $method = 'setting/GetProductCategories';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetServiceCategories()
    {
        $method = 'setting/GetServiceCategories';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetContactCategories()
    {
        $method = 'setting/GetContactCategories';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetFiscalYears()
    {
        $method = 'setting/GetFiscalYears';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetFiscalYear()
    {
        $method = 'setting/GetFiscalYears';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetProjects()
    {
        $method = 'setting/GetProjects';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetCurrencyTable()
    {
        $method = 'setting/GetCurrencyTable';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingSetCurrencyTable($table)
    {
        $method = 'setting/SetCurrencyTable';
        $data = array(
            'Table' => ($table)
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetAccounts()
    {
        $method = 'setting/GetAccounts';
        $data = array();

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function settingGetSalesmen()
    {
        $method = 'setting/GetSalesmen';
        $data = array();
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function reportInventory($data)
    {
        $method = 'report/inventory';
        $data = array(
            'startDate' => $data["startDate"],
            'endDate' => $data["endDate"]
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function reportTrialBalance($data)
    {
        $method = 'report/trialbalance';

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function reportTrialBalanceItems($data)
    {
        $method = 'report/trialbalanceitems';
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function reportBalancesheet($data)
    {
        $method = 'report/balancesheet';
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function reportDebtorsCreditors($data)
    {
        $method = 'report/debtorscreditors';
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function reportProfitAndLossStatement($data)
    {
        $method = 'report/profitandlossstatement';
        $data = array(
            'startDate' => $data["startDate"],
            'endDate' => $data["endDate"],
            'project' => $data["project"],
        );
        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function getOnlineInvoiceUrl($data)
    {
        $method = 'invoice/getonlineinvoiceurl';
        $data = array(
            'number' => $data['number'],
            'type' => $data['type'],
        );

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function saveWarehouseReceipt($receipt, $deleteOldReceipts)
    {
        $method = 'invoice/SaveWarehouseReceipt';
        $data = array(
            'deleteOldReceipts' => $deleteOldReceipts,
            'receipt' => $receipt,
        );

        return $this->apiRequest($method, $data);
    }
//================================================================================================
    public function itemDelete($code)
    {
        $method = 'item/delete';
        $data = array(
            'code' => $code,
        );

        return $this->apiRequest($method, $data);
    }
//================================================================================================
}