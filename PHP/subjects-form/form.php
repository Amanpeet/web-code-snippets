<!doctype html>
<html>
<head>
</head>
	<body>

		<h4>Passing conditions:</h4>
		<p>Atleast 35 marks in Science and Maths</p><br>

		<h3>Your Result:</h3>

		<?php

			//$science, $math, $english, $hindi, $punjabi;

			$sci= $_POST["sci"];
			$math= $_POST["math"];
			$eng= $_POST["eng"];
			$hin= $_POST["hin"];
			$pun= $_POST["pun"];

			$percentage= ($sci + $math + $eng + $hin + $pun)/ 500 * 100;

			$result ="result";
			$count = 0;
			/*
			echo "subject $sci <br>";
			echo "subject $math <br>";
			echo "subject $eng <br>";
			echo "subject $hin <br>";
			echo "subject $pun <br>";
			*/

			echo "Percentage: $percentage % <br>";

			if ($sci <35 || $math <35){
				$result = "FAIL";
			}
			else if($eng < 35 || $hin < 35 || $pun < 35){
				$result ="PASS";
				if ($eng < 35 && $hin < 35){
					$result ="FAIL";
				}
				if ($hin < 35 && $pun < 35){
					$result="FAIL";
				}
				if ($eng < 35 && $pun < 35){
					$result ="FAIL";
				}
				if ($eng < 35 && $hin < 35 && $pun < 35){
					$result="FAIL";
				}
			}
			else{
				$result ="PASS";
			}

			echo "Result: $result ! <br>"


		?>

	</body>
</html