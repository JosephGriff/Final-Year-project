<?php

class SalesController{

	// Show Sales
    static public function ShowSalesController($item, $value){

		$table = "sales";

		$answer = ModelSales::ShowSalesModel($table, $item, $value);

		return $answer;

	}

    static public function SaleController(){

        // Make Sale
		if(isset($_POST["newSale"])){

			$productsList = json_decode($_POST["productsList"], true);

			$totalPurchase = array();

			foreach ($productsList as $key => $value) {

			   array_push($totalPurchase, $value["quantity"]);
				
			   $tableProducts = "products";

			    $item = "id";
			    $valueProductId = $value["id"];
			    $order = "id";

			    $getProduct = ProductsModel::ShowProductsModel($tableProducts, $item, $valueProductId, $order);

				$item1 = "sales";
				$value1 = $value["quantity"] + $getProduct["sales"];

			    $newSales = ProductsModel::UpdateProductModel($tableProducts, $item1, $value1, $valueProductId);

				$item2 = "stock";
				$value2 = $value["stock"];

				$newStock = ProductsModel::UpdateProductModel($tableProducts, $item2, $value2, $valueProductId);

			}

			$table = "sales";

            $data = array("idSeller"=>$_POST["idSeller"],
                          "code"=>$_POST["newSale"],
						  "products"=>$_POST["productsList"],
						  "tax"=>$_POST["newSaleTotal"],
						  "netPrice"=>$_POST["netPrice"],
						  "totalPrice"=>$_POST["newSaleTotal"],
						  "paymentMethod"=>$_POST["newPaymentMethod"]);

			$answer = ModelSales::AddSaleModel($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "Sale Succesfull",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "sales";

								}
							})

				</script>';

			}

		}

    }

}