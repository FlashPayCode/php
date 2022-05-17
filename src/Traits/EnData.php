<?php

    namespace FlashPay\Lib\Traits;
    
    trait EnData {

        protected $dat="";

        protected $chk="";

        protected $ver="";

        protected $err="";


        public function getDat()
        {
            return $this->dat;
        }

        public function getChk()
        {
            return $this->chk;
        }

        public function getVer()
        {
            return $this->ver;
        }

        public function getErr()
        {
            return $this->err;
        }

        public function setDat($dat)
        {
            $this->dat = $dat;
        }

        public function setChk($chk)
        {
            $this->chk = $chk;
        }

        public function setVer($ver)
        {
            $this->ver = $ver;
        }

        public function setErr($err)
        {
            $this->err = $err;
        }

    }
    