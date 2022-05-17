<?php

    namespace FlashPay\Lib\Traits;
    
    trait HashInfo {

        protected $hashIv;

        protected $hashKey;


        public function getHashIv()
        {
            return $this->hashIv;
        }

        public function getHashKey()
        {
            return $this->hashKey;
        }

        public function setHashIv($iv)
        {
            $this->hashIv = $iv;
        }

        public function setHashKey($key)
        {
            $this->hashKey = $key;
        }



    }
    