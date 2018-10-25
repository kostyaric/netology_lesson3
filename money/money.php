<?php 
	
	$today = date('Y-m-d');
	
	if ($argc > 2) {

		$file = fopen('money.csv', 'a');

		if ($file !== FALSE) {

			$sum = $argv[1];
			$thing = array_slice($argv, 2);
			$thing = implode(' ', $thing);
			
			fputcsv($file, [$today, $sum, $thing]);
			fclose($file);
		}

		echo "We bought: $thing on $sum";
	}
	
	elseif ($argc === 2 && $argv[1] === '--today') {
		
		if (file_exists('money.csv')) {

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
			echo "There is no file money.csv";
		}
	}

	else {
		echo 'Wrong params';
	}

?>