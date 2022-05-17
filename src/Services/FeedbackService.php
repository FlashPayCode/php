<?php

namespace FlashPay\Lib\Services;

use Exception;
use FlashPay\Lib\obj\AesObj;
use FlashPay\Lib\Traits\EnData;

class FeedbackService extends AesObj
{
    use EnData;

    public function __construct($hashKey,$hashIv,$input)
    {
        parent::__construct($hashKey,$hashIv);
        if(empty($input)==true)
            throw new Exception('input is null');
        parse_str($input,$array);
        if(empty($array['dat'])!=true && empty($array['dat'])!=true)
        {
            if(strtoupper($this->getHASH($array['dat']))!=$array['chk'])
                throw new Exception('chk is error');
            $this->setdat($array['dat']);
            $this->setChk($array['chk']);
            $this->setVer($array['ver']);
        }else
        {
            $this->setErr($input);
        }
    }

    public function getRetrunJson()
    {
       
        if(empty($this->dat)!=true)
                return $this->create_mpg_aes_decrypt($this->dat);
        else{
            return $this->err;
        }
    }

}