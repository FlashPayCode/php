<?php

require '../vendor/autoload.php';
 
use FlashPay\Lib\Services\OrderService;
use FlashPay\Lib\Services\UtilService;
use FlashPay\Lib\Services\QueryOrderService;
use FlashPay\Lib\Services\DoTradeService;
use FlashPay\Lib\TradeConfig\PaymentMethods;
use FlashPay\Lib\TradeConfig\PaymentMethodsItem;


/*
*hashKey
*hashIv
*/
$hashInfo =[
	'hashKey'=>'hULtXjAWIHP6QDhLK1Oxp7Mi47MtPJwg',
	'hashIv' =>'JX3YbUmQYZm6ZTAZ',
];

/*
*create 訂單與訂單送出
*   PaymentMethods::Credit 信用卡交易  , PaymentMethods::Union 銀聯卡交易(沒有分期功能 只能用 PaymentMethodsItem::Union_all)
*/
 $inpust=[
	  'mer_id' => 'HT00000003',
	  'ord_no' =>'10494',
	  'pay_type' => PaymentMethods::Credit,
	  'amt' =>'100',
	  'order_desc'=>'45254456546464',
	  'ord_time' =>new DateTime(),
	  'install_period'=>PaymentMethodsItem::Credit_all,
	  'phone'=>'0912345678',
	  'return_url'=>'https://fl-pay.com',
	  'client_url'=>'https://fl-pay.com',
	  'sto_id'   =>'My store'
 ];
 $orderService = new OrderService($hashInfo);
 $Order =$orderService->createOrder($inpust);
 echo $orderService->checkout($Order,UtilService::$stageURL);

/*
* 單筆訂單查詢
* param  店商代號
* param  訂單編號
* param  api URL (UtilService::$stageURL 測試環境   , UtilService::$ProdutionURL 正式環境)
*/
 
$queryOrderService = new QueryOrderService($hashInfo);
echo $queryOrderService->queryOrder('HT00000003','10455',UtilService::$stageURL);

/*
* 多筆訂單查詢
* param  店商代號
* param  起訖日期
* param  結束日期
* (不能大於30天) 
* param  api URL (UtilService::$stageURL 測試環境   , UtilService::$ProdutionURL 正式環境)
*/
$beginDate    = new DateTime('2022-04-08');
$endDate    = new DateTime('2022-04-30');
$queryOrderService = new QueryOrderService($hashInfo);
echo $queryOrderService->queryMultiOrder('HT00000003',$beginDate ,$endDate,UtilService::$stageURL);


/*
*取消授權
* param  店商代號
* param  訂單編號
* param  訂單總經額
* param  api URL (UtilService::$stageURL 測試環境   , UtilService::$ProdutionURL 正式環境)
*/
$doTradeService =new DoTradeService($hashInfo);
echo $doTradeService->cancelAuth('HT00000003','10494',100,UtilService::$stageURL);
