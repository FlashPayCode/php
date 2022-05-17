<?php
namespace FlashPay\Lib\Services;

use FlashPay\Lib\obj\AesObj;
use FlashPay\Lib\obj\CurlObj;
use FlashPay\Lib\interface\CurlInterface;

class DoTradeService extends AesObj implements CurlInterface
{


    public function __construct($input)
    {
        parent::__construct($input['hashKey'],$input['hashIv']);
    }


    public function cancelAuth($merID,$orderNo,$orderPrice,$url)
    {
        $data=[
            'mer_id' =>  $merID,
            'ord_no' =>  $orderNo,
            'amt'    =>  $orderPrice,
            'tx_type' => 8,
       ];
       $dataJson=json_encode($data);
       $request=$this->getEnData($merID,$dataJson);
       $jsonReq = json_encode($request);
       return $this->run($jsonReq,$url."/querytrade.php");

    }


    public function run($request, $url)
    {
        $curl=new CurlObj();
        $curl->setHeaders( 'Content-Type: application/json');
        $returnDate =$curl->run($request ,$url);
        $feeback=new FeedbackService($this->getHashKey(),$this->getHashIv(),$returnDate);
        return $feeback->getRetrunJson();
    }




}