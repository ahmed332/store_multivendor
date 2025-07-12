<?php 
namespace B;
use \A\person as pr;
class person extends pr{
    const MAIL = 'M';
    const FEMAIL = 'M';
    public $name;
    public static $country;
    protected $gender;
    private  $age;
    public function setAge($age){
        $this->age =$age;
        return $this;
    }
    public function setGender($gender){
        $this->gender=$gender;
        return $this;
    }
    public static function setCountry($country){
        self::$country=$country;
    }

}










?>