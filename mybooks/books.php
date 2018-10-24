<?php

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
			
			$id = $book['id'];
			$title = $book['volumeInfo']['title'];

			$authors = $book['volumeInfo']['authors'];
			if (is_array($authors)) {
				$authors = implode(', ', $authors);
			}
			fputcsv($file, [$id, $title, $authors]);
		}
		
		fclose($file);
	}

?>