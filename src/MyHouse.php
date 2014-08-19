<?php
namespace olha\city;
class MyHouse{
    public $numberHouse; //номер дома
    public $numberOfFloor;//количество этажей
    public $numberOfEntrance;//количество подъездов
    public $apartments = array();//массив квартир
    public $squareOfArea;// площадь прилегающей территории
    const VOLUME=32.5;//Объем электричества на 1 этаж
    const DANEGELD=25.6;//Коэффициент расчета налога на землю
    
    function __construct($houseI, $apartmentI){
        $houseIni=$houseI->getBuilding();
        $this->numberHouse = $houseIni['numHouse'];
        $this->numberOfFloor = $houseIni['numbFloors'];
        $this->numberOfEntrance = $houseIni['numbEntr'];
        $this->squareOfArea = $houseIni['sqArea'];
        $this->setAppart($apartmentI);
             echo "<br>";
        }
// заполняем массив с квартирами
    function setAppart($apartmentI){
        $countFlat=$this->numberOfEntrance*$this->numberOfFloor*2;
        for($i=0; $i<$countFlat; $i++){
             $apartmentIni = $apartmentI->getApartment();
             $appart[$i] = new MyFlat($apartmentIni);
        }  
        $this->apartments = $appart;
    }
//рассчитывает размер коммунальных платежей со всех квартир в этом доме; 
    function totalRent(){
       $countFlat=$this->numberOfEntrance*$this->numberOfFloor*2;
       $total=0;
       for($i=0; $i<$countFlat; $i++){
            $total += $this->apartments[$i]->rentMonth();
        }
        return ($total);
       }
 //рассчитывает объем потребляемого электричества для освещения подъездов
       function electicVolume(){
           $d=$this->numberOfEntrance*$this->numberOfFloor*self::VOLUME;
           return ($d);
       }
//рассчитывает размер налога на землю
       function danegeld(){
           return ($this->squareOfArea*self::DANEGELD);
       }
       function infoAboutHouse(){
        echo 'Номер дома: <strong>'.$this->numberHouse.'</strong><br>';
        echo 'Количество этажей: '.$this->numberOfFloor.'<br>';
        echo 'Количество подъездов: '.$this->numberOfEntrance.'<br>';
        echo 'Площадь прилегающей территории: '.$this->squareOfArea.'<br>';
        echo "Размер коммунальных платежей со всех квартир в этом доме: ".$this->totalRent()."<br>";
        echo "Объем электричества на освещение подъездов: ".$this->electicVolume().'<br>'; 
        echo "Налог на землю: ".$this->danegeld().'грн<br>';
        }
 }
?>