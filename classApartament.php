<?php

class Apartament {

    const HEATING_COST = 16.42; //цена отопления за м2
    const HW_COST1 = 122.76;  //цена за горячую воду на 1 человека при присутствии полотенцесушителя
    const HW_COST2 = 114.06;  //цена за горячую воду на 1 человека при отсутствии полотенцесушителя
    const WS_COST1 = 45.98;  //цена водоснабж. на 1 человека, если оно централизованное
    const WS_COST2 = 63.00;  //цена водоснабж. на 1 человека, если стоит газовая колонка
    const SAN_COST1 = 35.70;  //цена за водоотведение, если в данный период есть горячая вода
    const SAN_COST2 = 26.05;  //цена за водоотведение, если в данный период нет горячей воды
    const EL_COST1 = 0.366;  //цена за электричество до 100кВт/ч
    const EL_COST2 = 0.63;  //цена за электричество от 100 до 600кВт/ч
    const EL_COST3 = 1.407;  //цена за электричество свыше 600кВт/ч
    const GAS_COST1 = 43.128;  //цена за газ при централизованном водоснабжении
    const GAS_COST2 = 129.384; //цена за газ при газовой колонке и водонагревателе
    const GAS_COST3 = 64.692;  //цена за газ при газовой колонке и отсутствии водонагревателя

    public $nfloor;
    public $nres;
    public $nrooms;
    public $nbalc;
    public $area;
    public $watercentr;
    public $hotwater;
    public $heating;
    public $heattowel;
    public $waterheater;
    public $electricity;

    function __construct($nfloor, $nres, $nrooms, $nbalc, $area, $watercentr, $hotwater, $heating, $heattowel, $waterheater, $electricity) {
        $this->nfloor = $nfloor;
        $this->nres = $nres;
        $this->nrooms = $nrooms;
        $this->nbalc = $nbalc;
        $this->area = $area;
        $this->watercentr = $watercentr;
        $this->hotwater = $hotwater;
        $this->heating = $heating;
        $this->heattowel = $heattowel;
        $this->waterheater = $waterheater;
        $this->electricity = $electricity;
    }

    public function show_flat() {
        $show = "<table><tr><td>Квартира:</td><td></td></tr>
		<tr><td>Кол-во жильцов:</td><td class='col2'>" . $this->nres . "</td></tr>
		<tr><td>Этаж:</td><td class='col2'>" . $this->nfloor . "</td></tr>
		<tr><td>Площадь квартиры:</td><td class='col2'>" . $this->area . " м2</td></tr>
		<tr><td>Кол-во комнат:</td><td class='col2'>" . $this->nrooms . "</td></tr>
		<tr><td>Кол-во балконов:</td><td class='col2'>" . $this->nbalc . "</td></tr>
		<tr><td>Потр. электроэн-я:</td><td class='col2'>" . $this->electricity . " кВт/ч</td></tr>
		<tr><td>Тип водоснабжения:</td><td class='col2'>";
        if ($this->watercentr == 1)
            $show.="центр-ное</td></tr>";
        else
            $show.="газ. кол.</td></tr>";
        $show.="<tr><td>Горячая вода:</td><td class='col2'>";
        if ($this->hotwater == 1)
            $show.="есть</td></tr>";
        else
            $show.="нет</td></tr>";
        $show.="<tr><td>Период:</td><td class='col2'>";
        if ($this->heating == 1)
            $show.="отоп.</td></tr>";
        else
            $show.="неот.</td></tr>";
        $show.="<tr><td>Полотенцесушитель:</td><td class='col2'>";
        if ($this->heattowel == 1)
            $show.="есть</td></tr>";
        else
            $show.="нет</td></tr>";
        $show.="<tr><td>Водонагреватель:</td><td class='col2'>";
        if ($this->waterheater == 1)
            $show.="есть</td></tr>";
        else
            $show.="нет</td></tr>";
        return $show;
    }

    public function __toString() {
        return
                $this->show_flat() .
                "<tr><td>Отопление:</td><td class='col2'>" . $this->get_heating() . " грн</td></tr>
		<tr><td>Горячая вода:</td><td class='col2'>" . $this->get_hotwater() . " грн</td></tr>
		<tr><td>Водоснабжение:</td><td class='col2'>" . $this->get_water_supply() . " грн</td></tr>
		<tr><td>Водоотведение:</td><td class='col2'>" . $this->get_sanitation() . " грн</td></tr>
		<tr><td>Электричество:</td><td class='col2'>" . $this->get_electricity() . " грн</td></tr>
		<tr><td>Квартплата:</td><td class='col2'>" . $this->get_rent() . " грн</td></tr>
		<tr><td>Газ:</td><td class='col2'>" . $this->get_gas() . " грн</td></tr>
		<tr><td>Месячный платеж за все коммунальные услуги:</td><td class='col2'>" . $this->get_all() . " грн</td></tr></table>";
    }

    //отопление
    public function get_heating() {
        if ($this->heating)
            return $this->area * self::HEATING_COST;
        else
            return 0;
    }

    //горячая вода в зависимости от присутствия полотенцесушителя
    public function get_hotwater() {
        if ($this->heattowel == 1)
            return $this->nres * self::HW_COST1;
        else
            return $this->nres * self::HW_COST2;
    }

    //водоснабжение централизованное горячее или газовая колонка
    public function get_water_supply() {
        if ($this->watercentr == 1)
            return $this->nres * self::WS_COST1;
        else
            return $this->nres * self::WS_COST2;
    }

    //водоотведение в зависимости от присутствия горячей воды
    public function get_sanitation() {
        if ($this->hotwater == 1)
            return $this->nres * self::SAN_COST1;
        else
            return $this->nres * self::SAN_COST2;
    }

    //электричество
    public function get_electricity() {
        if ($this->electricity == 0)
            return 0;
        if ($this->electricity < 100)
            return $this->electricity * self::EL_COST1;
        if ($this->electricity > 100 && $this->electricity < 600)
            return $this->electricity * self::EL_COST2;
        if ($this->electricity > 600)
            return $this->electricity * self::EL_COST3;
    }

    //газ
    public function get_gas() {
        if ($this->watercentr == 1)  //централизованное горячее водоснабжение
            return $this->nres * self::GAS_COST1;
        elseif ($this->waterheater == 1) //водонагреватель есть
            return $this->nres * self::GAS_COST2;
        else
            return $this->nres * self::GAS_COST3;
    }

    //квартплата
    public function get_rent() {
        return $this->area * 1.80;
    }

    public function get_all() {
        return $this->get_heating() + $this->get_hotwater() + $this->get_water_supply() + $this->get_sanitation() + $this->get_electricity() + $this->get_gas() + $this->get_rent();
    }

}

