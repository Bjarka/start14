<?php
namespace olha\city;
class MyFlat{
    public $nApart;//номер квартиры
    public $numberRooms;//количество комнат
    public $square;//площадь
    public $floor;//этаж
    public $balcony;//количество балконов
    public $inmate;//количество жильцов
    public $heating;//вид отопления
    const INDEXFLOOR = 2.5;//коэффициент квартплаты, если квартира выше 1-го этажа
    const INDEXONEFLOOR = 2.07;//коэффициент квартплаты, если квартира на 1-м этаже
    const INDEXHEATING=9.58;//коэффициент для расчета отопления
    const INDEXHOTWATER=14.5;//коэффициент для расчета горячей воды
    const INDEXCOLDWATER=25.7;//коэффициент для расчета холодной воды
    
  function __construct($apartmentI) {
        $this->nApart = $apartmentI['nAp'];
        $this->numberRooms = $apartmentI['nroom'] ;
        $this->square = $apartmentI['nroom']*$apartmentI['sqroom'];
        $this->floor = $apartmentI['floor'];
        $this->balcony = $apartmentI['balcony'];
        $this->inmate = $apartmentI['inmate'];
        if ($apartmentI['heating']==1)
            $this->heating = 'централизованное';
        else $this->heating = 'автономное';
    }
   function rent(){
        if($this->floor==1)
        $rent=$this->square*self::INDEXONEFLOOR;
        else $rent=$this->square*self::INDEXFLOOR;
        return($rent);
    }
  function heating(){
        return($this->square*self::INDEXHEATING);
    }
   function hotWaner(){
        return($this->inmate*self::INDEXHOTWATER);
    }
    function coldWater(){
        return($this->inmate*self::INDEXCOLDWATER);
    }
    function rentMonth(){
      return ($this->rent()+$this->heating()+$this->hotWaner()+$this->coldWater());
    }
    function MoveInmate($number, $flag){
       if($flag=='add') {$this->inmate+=$number;}
           elseif ($flag=='remove' & $this->inmate>$number) {
               $this->inmate-=$number;
       }
       else echo 'Жильцов меньше,чем вы хотите удалить'.'<br>';
       return ($this->inmate);
    }
    function infoAboutFlat(){
        echo 'Номер квартиры: '.$this->nApart.'<br>';
        echo 'Количество жильцов: '.$this->inmate.'<br>';
        echo 'Количество комнат: '.$this->numberRooms.'<br>';
        echo 'Площадь квартиры: '.$this->square.'<br>';
        echo 'Этаж квартиры: '.$this->floor.'<br>';
        echo 'Количество балконов: '.$this->balcony.'<br>';
        echo 'Тип отопления: '.$this->heating.'<br>';
        echo 'Платеж за месяц за коммунальные услуги: '.$this->rentMonth().'<br>';
    }
}
?>