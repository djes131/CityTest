<?php

class City {

    public $title;
    public $year;
    public $lat;
    public $lon;
    public $nstreets;
    public $streets = [];

    function __construct($title, $year, $lat, $lon, $nstreets) {
        $this->title = $title;
        $this->year = $year;
        $this->lat = $lat;
        $this->lon = $lon;
        $this->nstreets = $nstreets;
    }

    public function show_town() {
        return
                "<div class='town'><table><tr><td>Название города:</td><td>" . $this->get_title_town() . "</td></tr>
		<tr><td>Год основания:</td><td>" . $this->year . "</td></tr>
		<tr><td>Координаты:</td><td>" . $this->lat . ", " . $this->lon . "</td></tr>
		<tr><td>Количество улиц:</td><td>" . count($this->streets) . "</td></tr>";
    }

    public function __toString() {
        return
                $this->show_town() .
                "<tr><td>Бюджет населенного пункта: </td><td>" . $this->get_tax_town() . " грн</td></tr>
		<tr><td>Количество жителей:</td><td>" . $this->get_residents_town() . "</td></tr>
		<tr><td>Месячный платеж за все коммунальные услуги:</td><td>" . $this->get_all_town() . " грн</td></tr>
		<tr><td>Площадь улиц:</td><td>" . $this->get_area_town() . "</td></tr>
		<tr><td>Количество дворников:</td><td>" . $this->get_janitors_town() . "</td></tr></table></div>";
    }

    //добавляем улицу в массив улиц
    public function add_street($street) {
        $this->streets[] = $street;
    }

    //выводим улицы в городе
    public function get_streets() {
        $t_streets = "";
        foreach ($this->streets as $v)
            $t_streets.="<div class='street'>" . $v . "</div>";
        return $t_streets;
    }

    //название города
    public function get_title_town() {
        foreach ($this->title as $v)
            $title = $this->title[array_rand($this->title)];
        return $title;
    }

    //бюджет населенного пункта
    public function get_tax_town() {
        $tax_town = 0;
        foreach ($this->streets as $v)
            $tax_town+=$v->get_tax_street();
        return $tax_town;
    }

    //количество жителей в населенном пункте
    public function get_residents_town() {
        $residents_town = 0;
        foreach ($this->streets as $v)
            $residents_town+=$v->get_residents_street();
        return $residents_town;
    }

    //месячный платеж за все коммунальные услуги населенного пункта
    public function get_all_town() {
        $all_town = 0;
        foreach ($this->streets as $v)
            $all_town+=$v->get_all_street();
        return $all_town;
    }

    //площадь всех улиц
    public function get_area_town() {
        $area_town = 0;
        foreach ($this->streets as $v)
            $area_town+=$v->get_area();
        return $area_town;
    }

    //количество дворников в населенном пункте
    public function get_janitors_town() {
        $janitors_town = 0;
        foreach ($this->streets as $v)
            $janitors_town+=$v->get_janitors();
        return $janitors_town;
    }

}

