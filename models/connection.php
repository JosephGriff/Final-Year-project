<?php

class Connection{

	public static function connect(){

		$link = new PDO("mysql:host=localhost;dbname=restaurantpos", "root", "");
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$link -> exec("set names utf8");

		return $link;
	}

}