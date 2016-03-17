<?php

require "../torophp/toro.php";
require "../../funciones.php";

ToroHook::add("404", function () {
	echo "Not found";
});

class DBHandler {

	function get($name = null) {
		// como en el ejemplo anterior
	}

	function post($name = null) {

		$db = array('pedidos' => array('name' => 'Spain', 'area' => 78349, 'population' => 25000000, 'language' => 'Spanish'),
			'france' => array('name' => 'France', 'area' => 120000, 'population' => 43000000, 'language' => 'French'),
		);

		// try {
		//   $dbh = new PDO('sqlite:test.db');
		// } catch (Exception $e) {
		//   die("Unable to connect: " . $e->getMessage());
		// }
		try {
			$area = $_POST['area'];
			$population = $_POST['population'];
			$language = $_POST['language'];
			// echo $area;

			// $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// $stmt = $dbh->prepare("UPDATE countries SET area=:area,
			//                       population=:population, density=:density
			//                       WHERE name = :name");
			// $stmt->bindParam(':area', $area);
			// $stmt->bindParam(':population', $population);
			// $stmt->bindParam(':density', $density);

			// $dbh->beginTransaction();
			// $stmt->execute();
			// $dbh->commit();
			array_push($db, array('name' => $name, 'area' => $area, 'population' => $population, 'language' => $language));
			foreach ($db as $key => $value) {
				$data[] = $value;

			}
			echo json_encode($data);

		} catch (Exception $e) {
			// $dbh->rollBack();
			echo "Failed: " . $e->getMessage();
		}
	}

}

Toro::serve(array(
	"/country" => "DBHandler",
	"/country/:alpha" => "DBHandler",
));
?>