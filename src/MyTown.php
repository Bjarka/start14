<?php
namespace olha\city;
class MyTown{
   public  $nameTown;//название населенного пункта
   public  $foundation;//год основания
   public  $position;//географические координаты 
   public  $numbeStreets;// количество улиц
   public  $streets = array();//массив улиц
   
   function __construct($townI, $streetI, $houseI, $apartmentI){
        $nameTown = array('Kharkov', 'Symmi','Poltava','Ahtirka',);
        $townIni=$townI->getTown();
        $this->nameTown = $nameTown[$townIni['ntown']];
        $yearFound = array(
            'Kharkov' => 1654,
            'Symmi' => 1780, 
            'Poltava' => 1641,
            'Ahtirka' => 1703
        );
        $this->foundation = $yearFound[$this->nameTown];
         $positionArray = array(
            'Kharkov' => '50°с.ш.36°в.д.',
            'Symmi' => '50°с.ш.34°в.д.', 
            'Poltava' => '49°с.ш.34°в.д.',
            'Ahtirka' => '50°с.ш.34°в.д.'
        );
        $this->position = $positionArray[$this->nameTown];
        $this->numbeStreets = $townIni['nstreet'];
      for($i=0; $i < $townIni['nstreet']; $i++){
            $StreetArr[$i] = new MyStreet($streetI, $houseI, $apartmentI);       
       }  
        $this->streets = $StreetArr;
    } 
//  бюджет населенного пункта в зависимости от размера налога на землю
    function buget(){
        $countPayment=0;
        foreach($this->streets as $value){
            $countPayment+=$value->volumePayment();
        }
       return $countPayment;
    }
//количество населения, проживающего в населенном пункте
    function population(){
        $counterPopulation=0;
        foreach($this->streets as $value1){
            foreach($value1->houses as $value2){
                foreach($value2->apartments as $value3){
                    $counterPopulation+=$value3->inmate;
                }
            }
        }
        return $counterPopulation;
    }       
 // информация о городе
    function infoAboutTown(){
        echo 'Название города: <strong>'.$this->nameTown.'</strong><br>';
        echo 'Год основания города: '.$this->foundation.'год'.'<br>';
        echo 'Географические координаты: '.$this->position.'<br>';
        echo 'Количество улиц: '.$this->numbeStreets.'<br>';
        echo "Бюджет населенного пункта: ".$this->buget()."грн.".'<br>';
        echo "Количество населения, проживающего в населенном пункте: ".$this->population().'чел'.'<br>'; 
    }
}
?>