<?php

class Establishment {

    public $nhouse;
    public $naccess;
    public $nfloors;
    public $flats = [];
    public $area;
    public $electricity;

    const FLATSFLOOR = 5;
    const A = 3.66;   //ставка налога на землю
    const B = 3;    //коэффициент индексации налога на землю

    function __construct($nhouse, $naccess, $nfloors, $area, $electricity) {
        $this->nhouse = $nhouse;
        $this->naccess = $naccess;
        $this->nfloors = $nfloors;
        $this->area = $area;
        $this->electricity = $electricity;
    }

    public function show_house() {
        $show2 = "<table><tr><td>Номер дома:</td><td>" . $this->nhouse . "</td></tr>
		<tr><td>Количество подъездов:</td><td>" . $this->naccess . "</td></tr>
		<tr><td>Количество этажей:</td><td>" . $this->nfloors . "</td></tr>
		<tr><td>Количество квартир:</td><td>" . count($this->flats) . "</td></tr>
		<tr><td>Площадь прилегающей территории:</td><td>" . $this->area . " м2</td></tr>";
        return $show2;
    }

    public function __toString() {
        return
                $this->show_house() . "
		<tr><td>Количество жителей:</td><td class='col2'>" . $this->get_residents_house() . "</td></tr>
		<tr><td>Отопление:</td><td class='col2'>" . $this->get_heating_house() . " грн</td></tr>
		<tr><td>Горячая вода:</td><td class='col2'>" . $this->get_hotwater_house() . " грн</td></tr>
		<tr><td>Водоснабжение:</td><td class='col2'>" . $this->get_water_supply_house() . " грн</td></tr>
		<tr><td>Водоотведение:</td><td class='col2'>" . $this->get_sanitation_house() . " грн</td></tr>
		<tr><td>Электричество:</td><td class='col2'>" . $this->get_electricity_flats() . " грн</td></tr>
		<tr><td>Квартплата:</td><td class='col2'>" . $this->get_rent_house() . " грн</td></tr>
		<tr><td>Газ:</td><td class='col2'>" . $this->get_gas_house() . " грн</td></tr>
		<tr><td>Месячный платеж за все коммунальные услуги:</td><td class='col2'>" . $this->get_all_house() . " грн</td></tr>
		<tr><td>Потребляемое электричество:</td><td class='col2'>" . $this->get_electricity_house() . " кВт</td></tr>
		<tr><td>Налог на землю:</td><td class='col2'>" . $this->get_tax_house() . " грн</td></tr></table>";
    }

    //добавляем квартиру в массив квартир
    public function add_flat($flat) {
        $this->flats[] = $flat;
    }

    //выводим квартиры в доме
    public function get_flats() {
        $h_flats = "";
        foreach ($this->flats as $v)
            $h_flats.="<div class='flat'>" . $v . "</div>";
        return $h_flats;
    }

    //количество жителей в доме
    public function get_residents_house() {
        $residents_house = 0;
        foreach ($this->flats as $v)
            $residents_house+=$v->nres;
        return $residents_house;
    }

    //отопление со всех квартир
    public function get_heating_house() {
        $heating_house = 0;
        foreach ($this->flats as $v)
            $heating_house+=$v->get_heating();
        return $heating_house;
    }

    //горячая вода в зависимости от присутствия полотенцесушителя
    public function get_hotwater_house() {
        $hotwater_house = 0;
        foreach ($this->flats as $v)
            $hotwater_house+=$v->get_hotwater();
        return $hotwater_house;
    }

    //водоснабжение в доме
    public function get_water_supply_house() {
        $water_supply_house = 0;
        foreach ($this->flats as $v)
            $water_supply_house+=$v->get_water_supply();
        return $water_supply_house;
    }

    //водоотведение в доме
    public function get_sanitation_house() {
        $sanitation_house = 0;
        foreach ($this->flats as $v)
            $sanitation_house+=$v->get_sanitation();
        return $sanitation_house;
    }

    //электричество со всех квартир
    public function get_electricity_flats() {
        $electricity_flats = 0;
        foreach ($this->flats as $v)
            $electricity_flats+=$v->get_electricity();
        return $electricity_flats;
    }

    //газ в доме
    public function get_gas_house() {
        $gas_house = 0;
        foreach ($this->flats as $v)
            $gas_house+=$v->get_gas();
        return $gas_house;
    }

    //квартплата со всех квартир
    public function get_rent_house() {
        $rent_house = 0;
        foreach ($this->flats as $v)
            $rent_house+=$v->get_rent();
        return $rent_house;
    }

    //все коммунальные услуги для дома
    public function get_all_house() {
        return $this->get_heating_house() + $this->get_hotwater_house() + $this->get_water_supply_house() + $this->get_sanitation_house() + $this->get_electricity_house() + $this->get_gas_house() + $this->get_rent_house();
    }

    //потребляемое электричество в зависимости от кол-ва подъездов и этажей
    public function get_electricity_house() {
        return $this->naccess * $this->nfloors * $this->electricity;
    }

    //налог на землю
    public function get_tax_house() {
        $tax_house = 0;
        foreach ($this->flats as $v)
            $tax_house = $this->area * self::A * self::B;
        return $tax_house;
    }

}