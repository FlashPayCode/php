<?php
namespace FlashPay\Lib\Services;

use FlashPay\Lib\obj\AesObj;

class OrderService extends AesObj{

    public function __construct($input)
    {
        parent::__construct($input['hashKey'],$input['hashIv']);
    }

    public function createOrder($input){
       $array=$input;
        //銀聯卡分期功能還未開放
       if( $array['pay_type']==2)
            $array['install_period'] =0;
       $array['ver'] =UtilService::$version;
       $array['tx_type'] =101;
       $array['cur'] ="NTD";
       $array['ord_time'] =$array['ord_time']->format('Y-m-d H:i:s');
       return $array;
    }
    
    public function checkout($order,$action)
    {
       $jsonStr= json_encode($order);
       $output=$this->getEnData($order['mer_id'],$jsonStr);
       $form = $this->getForm($output,$action."/trade");
       $html =$this->getHTML($form);
       return $html;
    }

    private function getForm($input, $action)
    {
        $formAction = $this->escapeHtml($action);
        $form = '<form id="FLASHForm" method="POST" target="_self" action="' . $formAction . '">';
        foreach ($input as $name => $value) {
            $inputName = $this->escapeHtml($name);
            $inputValue = $this->escapeHtml($value);
            $form .= '<input type="hidden" name="' . $inputName . '" value="' . $inputValue . '">';
        }
        $form .= '</form>';
        return $form;
    }

    private function getHTML($form)
    {
        $html = '<!DOCTYPE html>';
        $html .= '<html>';
        $html .= '<head>';
        $html .= '<meta charset="utf-8">';
        $html .= '</head>';
        $html .= '<body>';
        $html .=$form;
        $html .= '<script type="text/javascript">';
        $html .= 'document.getElementById("FLASHForm").submit();';
        $html .= '</script>';
        $html .= '</body>';
        $html .= '</html>';
        return $html;
    }


    private function escapeHtml($value)
    {
        $escaped = $value;
        $doubleEncode = true;
        if (!empty($escaped)) {
            $escaped = htmlspecialchars($value, ENT_QUOTES, 'UTF-8', $doubleEncode);
        }
        return $escaped;
    }



}