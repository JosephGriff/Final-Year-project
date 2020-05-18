<?php

require_once 'connection.php';


class ModelSales{
	
    // Show Sales
	public static function ShowSalesModel($table, $item, $value){

		if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	public static function AddSaleModel($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(code, idSeller, tableNo, idCustomer, products, netPrice, discount, totalPrice, paymentMethod) VALUES (:code, :idSeller, :tableNo, :idCustomer, :products, :netPrice, :discount, :totalPrice, :paymentMethod)");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idSeller", $data["idSeller"], PDO::PARAM_INT);
		$stmt->bindParam(":tableNo", $data["tableNo"], PDO::PARAM_STR);
		$stmt->bindParam(":idCustomer", $data["idCustomer"], PDO::PARAM_STR);
		$stmt->bindParam(":products", $data["products"], PDO::PARAM_STR);
		$stmt->bindParam(":netPrice", $data["netPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":discount", $data["discount"], PDO::PARAM_STR);
		$stmt->bindParam(":totalPrice", $data["totalPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":paymentMethod", $data["paymentMethod"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	public static function getAll () {

        $stmt = Connection::connect()->prepare("SELECT sales.*, customers.name AS customer FROM sales LEFT JOIN customers ON sales.idCustomer = customers.id ORDER BY id ASC");
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		
        return $stmt->fetchAll();
	}
	
	public static function ReopenSaleModel($table1, $table2, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table2(code, idSeller, tableNo, idCustomer, products, netPrice, discount, totalPrice, paymentMethod) SELECT (:code), (:idSeller), (:tableNo), (:idCustomer), (:products), (:netPrice), (:discount), (:totalPrice), (:paymentMethod) FROM $table1");
		// $stmt1 = Connection::connect()->prepare("DELETE FROM $table1 WHERE id = :id");
		// $stmt1 -> bindParam(":id", $data, PDO::PARAM_INT);
		//$stmt = Connection::connect()->prepare("DELETE FROM $table1 OUTPUT [deleted].(:code), (:idSeller), (:tableNo), (:idCustomer), (:products), (:netPrice), (:discount), (:totalPrice), (:paymentMethod) INTO $table2 (code, idSeller, tableNo, idCustomer, products, netPrice, discount, totalPrice, paymentMethod)");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idSeller", $data["idSeller"], PDO::PARAM_INT);
		$stmt->bindParam(":tableNo", $data["tableNo"], PDO::PARAM_STR);
		$stmt->bindParam(":idCustomer", $data["idCustomer"], PDO::PARAM_STR);
		$stmt->bindParam(":products", $data["products"], PDO::PARAM_STR);
		$stmt->bindParam(":netPrice", $data["netPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":discount", $data["discount"], PDO::PARAM_STR);
		$stmt->bindParam(":totalPrice", $data["totalPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":paymentMethod", $data["paymentMethod"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	public static function DeleteSalesModel($table, $data){

		$stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt -> bindParam(":id", $data, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	///// date ranges

	public static function DatesRangeModel($table, $initialDate, $finalDate){

		if($initialDate == null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($initialDate == $finalDate){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE saledate like '%$finalDate%'");

			$stmt -> bindParam(":saledate", $finalDate, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
			
		}else{

			$actualDate = new DateTime();
			$actualDate ->add(new DateInterval("P1D"));
			$actualDatePlusOne = $actualDate->format("Y-m-d");

			$finalDate2 = new DateTime($finalDate);
			$finalDate2 ->add(new DateInterval("P1D"));
			$finalDatePlusOne = $finalDate2->format("Y-m-d");

			if($finalDatePlusOne == $actualDatePlusOne){

				$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE saledate BETWEEN '$initialDate' AND '$finalDatePlusOne'");

			}else{


				$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE saledate BETWEEN '$initialDate' AND '$finalDate'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
	}

	//adding total sales

	public 	static function sumTotalSalesModel($table){	

		$stmt = Connection::connect()->prepare("SELECT SUM(netPrice) as totalPrice FROM $table");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	
}