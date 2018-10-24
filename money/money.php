<?php 
	
	$today = date('Y-m-d');
	
	if ($argc === 3) {

		$file = fopen('money.csv', 'a');

		if ($file !== FALSE) {
			
			list(, $sum, $thing) = $argv;
			fputcsv($file, [$today, $sum, $thing]);
			fclose($file);
		}

		echo "We bought: $thing on $sum";
	}
	
	elseif ($argc === 2 & $argv[1] === "--today") {
		
		echo "today \n";
		$file = fopen('money.csv', 'r');
		
		if ($file !== FALSE) {
		
			$sumToday = 0;
			
			while (($rowarray = fgetcsv($file)) !== FALSE) {

				if ($rowarray[0] === $today) {
					$sumToday = $sumToday + (int)$rowarray[1];
				}
			}

			echo "Today we spent $sumToday";
			fclose($file);
			
		}
	}

	else {
		echo "Wrong params";
	}

?>