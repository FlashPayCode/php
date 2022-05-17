<?php 
     namespace FlashPay\Lib\TO;

class OrderItem{

    //名稱
	private $name;
	//價格
	private $price;
	//單位
	private $unit;
	//數量
	private $quantity;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getUnit()
    {
       return  $this->unit;
    }
    public function setUnit($unit)
    {
        $this->unit =$unit;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity($quantity)
    {
        $this->quantity=$quantity;
    }

    public function getProductStr()
    {
        return $this->name ." ". sprintf("%.2f", $this->price) . " X " . strval($this->quantity)." ".$this->unit;
    }

}