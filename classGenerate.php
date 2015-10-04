<?php

class Generate {

    public static function get_flat() {
        $nfloor = rand(1, 50);   //этаж
        $nres = rand(1, 15);   //кол-во жильцов
        $nrooms = rand(1, 20);   //кол-во комнат
        $nbalc = rand(1, $nrooms);  //кол-во балконов
        $area = rand(12, 600);   //площадь квартиры
        $watercentr = rand(0, 1);  //водоснабжение
        $hotwater = rand(0, 1);  //горячая вода
        $heating = rand(0, 1);   //отопительный сезон
        $heattowel = rand(0, 1);  //полотенцесушитель
        $waterheater = rand(0, 1);  //водонагреватель
        $electricity = rand(0, 1000); //потребленное электричество
        $flat = new Apartament($nfloor, $nres, $nrooms, $nbalc, $area, $watercentr, $hotwater, $heating, $heattowel, $waterheater, $electricity);
        return $flat;
    }

    public static function get_house() {
        $nhouse = rand(1, 50);   //№ дома
        $naccess = rand(1, 5);   //кол-во подъездов
        $nfloors = rand(1, 50);  //кол-во этажей
        $area = rand(100, 1000);  //площадь прилегающей территории
        $electricity = rand(0, 50); //потребленное электричество на этаже

        $house = new Establishment($nhouse, $naccess, $nfloors, $area, $electricity);
        for ($i = 0; $i < ($naccess * $nfloors * Establishment::FLATSFLOOR); $i++)
            $house->add_flat(self::get_flat());
        return $house;
    }

    public static function get_street() {
        $title = array("Героев Труда", "Блюхера", "Академика Павлова", "Тракторостроителей", "Тобольская", "23-го Августа");
        $start_lat = rand(49923, 50062) / 1000;  //начало улицы
        $start_lon = rand(36142, 36390) / 1000;
        $finish_lat = rand(49923, 50062) / 1000;  //конец улицы
        $finish_lon = rand(36142, 36390) / 1000;
        $nhouses = rand(1, 20);     //количество домов
        $street = new Avenue($title, $start_lat, $start_lon, $finish_lat, $finish_lon, $nhouses);
        for ($i = 0; $i < $nhouses; $i++)
            $street->add_house(self::get_house());
        return $street;
    }

    public static function get_town() {
        $title = array("Балаклея", "Первомайск", "Богодухов", "Змиев", "Чугуев", "Валки");
        $year = rand(1750, 1950);
        $lat = rand(49923, 50062) / 1000;   //координаты
        $lon = rand(36142, 36390) / 1000;
        $nstreets = rand(1, 20);     //количество улиц
        $town = new City($title, $year, $lat, $lon, $nstreets);
        for ($i = 0; $i < $nstreets; $i++)
            $town->add_street(self::get_street());
        return $town;
    }

}