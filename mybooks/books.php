<?php

	if ($argc < 2) {
		echo 'Необходимо указать фразу для поиска';
	}
	else {
		$qwery_string = '';
		for ($i = 1; $i < $argc; $i++) { 
			$qwery_string .= ($qwery_string == '' ? '' : ' ') . $argv[$i];
		}

		$qwery = urlencode($qwery_string);
		$jstring = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=' . $qwery);
		$arr_qwery = json_decode($jstring, true);
		$arr_books = $arr_qwery['items'];
		
		$file = fopen('books.csv', 'w');
		if ($file !== FALSE) {

			foreach ($arr_books as $book) {
				
				$id = !empty($book['id']) ? $book['id'] : '';
				$title = !empty($book['volumeInfo']['title']) ? $book['volumeInfo']['title'] : '';
				$authors = (!empty($book['volumeInfo']['authors'])) ? $book['volumeInfo']['authors'] : [];
				$authors = implode(', ', $authors);

				fputcsv($file, [$id, $title, $authors]);
			}
			
			fclose($file);
		}
	}

?>