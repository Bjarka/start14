<?php
namespace olha\city;
class MyStreet{
   public  $nameStreet;//название улицы
   public  $streetLength;//протяженность улицы
   public  $position;//координаты начала и конца улицы
   public  $numberHouse;// количество домов на улице
   public  $houses = array();//массив дома
   const   NORMAREA=250; //площадь на одного дворника
   
   function __construct($street, $houseI, $apartmentI){
        $nameAvenue = array('Symskaya', 'Petrovskogo','Ivanova','Bakulina','Saltovskoe shosse','Darvina');
        $streetIni=$street->getStreet();
        $this->nameStreet = $nameAvenue[$streetIni['nstreet']];
        $this->streetLength = $streetIni['length'];
        $this->position = $streetIni['posit'];
        $this->numberHouse = $streetIni['nhouse'];
        for($i=0; $i<$this->numberHouse; $i++){
             $houseArr[$i] = new MyHouse($houseI,$apartmentI);
        }  
            $this->houses=$houseArr;
    } 
  
    function streetCleaners(){
        $countSquare=0;
        foreach($this->houses as $value){
            $countSquare+=$value->squareOfArea;
        }
       return ceil($countSquare/self::NORMAREA);//количество дворников
    }
    function volumePayment(){
        $countPayment=0;
        foreach($this->houses as $value){
            $countPayment+=$value->totalRent();
        }
       return $countPayment;//
    }
    function infoAboutStreet(){
        echo 'Название улицы: <strong>'.$this->nameStreet.'</strong><br>';
        echo 'Протяженность улицы: '.$this->streetLength.'м'.'<br>';
        echo 'Координаты начала и конца улицы: '.$this->position.'<br>';
        echo 'Количество домов на улице: '.$this->numberHouse.'<br>';
        echo "Количество дворников, обслуживающие улицу: ".$this->streetCleaners()."чел".'<br>';
        echo "Объем коммунальных платежей, которые будут получены со всех домов: ".$this->volumePayment().'грн'.'<br>'; 

        }
    
}
?>