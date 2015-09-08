<?php
$list = $argv[1];
$words = file('words/' . $list . '.txt');
foreach ($words as &$word) {
	$word = trim($word);
	$wordLetters[$word] = str_split($word);
}

$previous = '';
$matches = [];
$continue = true;
while ($continue) {
	list($nextWord, $matches, $continue) = getNextWord($words);
	list($previous, $words) = calculate($words, $previous, $nextWord, $matches, $wordLetters);
}

function getNextWord($words) {
	$continue = true;
	foreach ($words as $key => $word) {
		echo $key . str_repeat(' ', (3 - strlen($key))) . ': ' . $word . "\n";;
	}

	echo 'Choose a word: ';
	$nextWord = trim(fgets(fopen("php://stdin","r")));
	echo 'How many matches: ';
	$matches = trim(fgets(fopen("php://stdin","r")));
	if ((int)$matches === strlen($words[0])) {
		echo 'Good Job! ' . $words[$nextWord] . ' is the correct password.' . "\n";
		$continue = false;
	}
	return [$nextWord, $matches, $continue];
}

function calculate($words, $previous = '', $nextWord, $matches, $wordLetters) {
	$selected = $words[$nextWord];
	$input = implode('.', array($selected, $matches));
	if ($previous) {
		$previous = implode (':', array($previous, $input));
	} else {
		$previous = $input;
	}

	$previousEntries = split(':', $previous);
	foreach ($previousEntries as $previousEntry) {
		list($pe_word,$pe_num) = split('\.', $previousEntry);
		$x=0;
		$matchWords = array();
		$wordsLeft = array();
		foreach ($wordLetters[$pe_word] as $letter) {
			foreach ($words as $word) {
				if ($wordLetters[$word][$x] == $letter) {
					$matchWords[$word]++;
				}
			}
			$x++;
		}
		foreach ($matchWords as $key => $match) {
			if ($match == $pe_num) {
				$wordsLeft[$key] = $key;
			}
		}
		$words = array_values($wordsLeft);
	}

	return [$previous, $words];
}

