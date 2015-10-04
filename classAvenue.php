<?php

class Avenue {

    public $title;
    public $start_lat;
    public $start_lon;
    public $finish_lat;
    public $finish_lon;
    public $nhouses;
    public $houses = [];

    function __construct($title, $start_lat, $start_lon, $finish_lat, $finish_lon, $nhouses) {
        $this->title = $title;
        $this->start_lat = $start_lat;
        $this->start_lon = $start_lon;
        $this->finish_lat = $finish_lat;
        $this->finish_lon = $finish_lon;
        $this->nhouses = $nhouses;
    }

    public function show_street() {
        return
                "<table><tr><td>Название улицы:</td><td>" . $this->get_title() . "</td></tr>
		<tr><td>Начало улицы:</td><td>" . $this->start_lat . ", " . $this->start_lon . "</td></tr>
		<tr><td>Конец улицы:</td><td>" . $this->finish_lat . ", " . $this->finish_lon . "</td></tr>
		<tr><td>Количество домов:</td><td>" . count($this->houses) . "</td></tr>";
    }

    public function __toString() {
        return
                $this->show_street() .
                "<tr><td>Протяженность улицы: </td><td>" . $this->get_length_street() . " км</td></tr>
		<tr><td>Налог на землю: </td><td>" . $this->get_tax_street() . " грн</td></tr>
		<tr><td>Количество жителей:</td><td>" . $this->get_residents_street() . "</td></tr>
		<tr><td>Отопление:</td><td>" . $this->get_heating_street() . " грн</td></tr>
		<tr><td>Горячая вода:</td><td>" . $this->get_hotwater_street() . " грн</td></tr>
		<tr><td>Водоснабжение:</td><td>" . $this->get_water_supply_street() . " грн</td></tr>
		<tr><td>Водоотведение:</td><td>" . $this->get_sanitation_street() . " грн</td></tr>
		<tr><td>Электричество в квартирах:</td><td>" . $this->get_electricity_houses() . " грн</td></tr>
		<tr><td>Квартплата:</td><td>" . $this->get_rent_street() . " грн</td></tr>
		<tr><td>Газ:</td><td>" . $this->get_gas_street() . " грн</td></tr>
		<tr><td>Месячный платеж за все коммунальные услуги:</td><td>" . $this->get_all_street() . " грн</td></tr>
		<tr><td>Площадь придомовых территорий:</td><td>" . $this->get_area() . "</td></tr>
		<tr><td>Количество дворников:</td><td>" . $this->get_janitors() . "</td></tr></table>";
    }

    //добавляем дом в массив домов
    public function add_house($house) {
        $this->houses[] = $house;
    }

    //выводим дома на улице
    public function get_houses() {
        $s_houses = "";
        foreach ($this->houses as $v)
            $s_houses.="<div class='house'>" . $v . "</div>";
        return $s_houses;
    }

    //название улицы
    public function get_title() {
        foreach ($this->title as $v)
            $title = $this->title[array_rand($this->title)];
        return $title;
    }

    //количество жителей на улице
    public function get_residents_street() {
        $residents_street = 0;
        foreach ($this->houses as $v)
            $residents_street+=$v->get_residents_house();
        return $residents_street;
    }

    //отопление со всех домов на улице
    public function get_heating_street() {
        $heating_street = 0;
        foreach ($this->houses as $v)
            $heating_street+=$v->get_heating_house();
        return $heating_street;
    }

    //горячая вода со всех домов
    public function get_hotwater_street() {
        $hotwater_street = 0;
        foreach ($this->houses as $v)
            $hotwater_street+=$v->get_hotwater_house();
        return $hotwater_street;
    }

    //водоснабжение
    public function get_water_supply_street() {
        $water_supply_street = 0;
        foreach ($this->houses as $v)
            $water_supply_street+=$v->get_water_supply_house();
        return $water_supply_street;
    }

    //водоотведение
    public function get_sanitation_street() {
        $sanitation_street = 0;
        foreach ($this->houses as $v)
            $sanitation_street+=$v->get_sanitation_house();
        return $sanitation_street;
    }

    //электричество
    public function get_electricity_houses() {
        $electricity_houses = 0;
        foreach ($this->houses as $v)
            $electricity_houses+=$v->get_electricity_flats();
        return $electricity_houses;
    }

    //квартплата со всех домов
    public function get_rent_street() {
        $rent_street = 0;
        foreach ($this->houses as $v)
            $rent_street+=$v->get_rent_house();
        return $rent_street;
    }

    //газ со всех домов
    public function get_gas_street() {
        $gas_street = 0;
        foreach ($this->houses as $v)
            $gas_street+=$v->get_gas_house();
        return $gas_street;
    }

    //все коммунальные услуги со всех домов
    public function get_all_street() {
        $all_street = 0;
        foreach ($this->houses as $v)
            $all_street+=$v->get_all_house();
        return $all_street;
    }

    //количество дворников
    public function get_janitors() {
        $all_area = 0;
        foreach ($this->houses as $v)
            $all_area+=$v->area;
        $janitors = ceil($all_area / 3000);
        return $janitors;
    }

    //общая площадь придомовых территорий
    public function get_area() {
        $all_area = 0;
        foreach ($this->houses as $v)
            $all_area+=$v->area;
        return $all_area;
    }

    //протяженность улицы
    public function get_length_street() {
        $length = round(sqrt(($this->finish_lat - $this->start_lat) * ($this->finish_lat - $this->start_lat) + ($this->finish_lon - $this->start_lon) * ($this->finish_lon - $this->start_lon)), 3) * 110;
        return $length;
    }

    //налог на землю
    public function get_tax_street() {
        $tax_street = 0;
        foreach ($this->houses as $v)
            $tax_street+=$v->get_tax_house();
        return $tax_street;
    }

}