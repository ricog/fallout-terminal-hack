<?php
$lists[1] = '
ADVERTISE
IMMEDIATE
ASCENSION
HUMANKIND
TECHNICAL
';

$lists[2] = '
DECLINE
SELLING
SERVANT
PRISONS
DRAGONS
LEGIONS
AIRLOCK
WARNING
MEANING
SEALING
SEALANT
WORKING
HEALING
WINNING
WELCOME
';

$lists[3] = '
IMAGINED
REPORTED
REVERTED
EXPLORED
PICTURES
DEFLATED
RELIEVED
PRESUMED
REPLACED
RETURNED
BORROWED
PARANOID
CARPETED
PERSONAL
REPELLED
IMPROVED
';

$lists[4] = '
SUNDRIES
STANDING
SOMEWHAT
CONSTANT
STUDYING
SNEAKING
SCOUTING
DEBATING
CONFLICT
CONFRONT
POSITION
SOFTWARE
SINISTER
TIMELINE
STEALING
SLEEPING
';

$lists[5] = '
PURIFIER
INFORMED
ENFORCED
UNWANTED
OVERSEES
REPORTED
REVERTED
OUTRAGED
ENTIRELY
ELEVATOR
INFRARED
EXPLORED
INFECTED
SPLINTER
INJECTED
INVENTED
';

$lists[6] = '
RECEIVING
STRANGEST
REMAINING
SURVIVING
SACRIFICE
SWIVELING
COMPUTERS
REMINDING
REPAIRING
';

$lists[7] = '
EXPLOSIVES
CONSISTING
APPROACHED
SKYSCRAPER
SEPARATING
';


?>

<html>
	<head>
		<title>Fallout 3 Hack Tool</title>
		<script type="text/javascript">
			function processWord(word) {
				document.getElementById('selected').value=word;
			}
		</script>
	</head>
	<body>
<?php
if (!$_GET['list']) {
?>
	<table border="1">
		<tr>
<?php
		foreach ($lists as $key => $list) {
					echo '<td valign="top">List ' . $key . '<br />';
							echo '<a href="fallout3.php?list=' . $key . '">' . nl2br($list) . '</a></td>';
						}
?>
</table>
<?php
			
} else {
		$list = $lists[$_GET['list']];
			$listNumber = $_GET['list'];
			$words = preg_split('/\r\n/', $list);
				foreach ($words as $word) {
							$wordLetters[$word] = str_split($word);
								}
}




$previous='';
if ($_GET['list'] && $_GET['submit']) {
?>
<b>Words</b><br />
<?php
		$previous = $_GET['previous'];
			$selected = $_GET['selected'];
			$matches = $_GET['matches'];
				$input = implode('.', array($selected, $matches));
				if ($previous) {
							$previous = implode (':', array($previous, $input));
								} else {
											$previous = $input;
												}
	
	$previousEntries = split(':', $previous);
	foreach ($previousEntries as $previousEntry) {
		list($pe_word,$pe_num) = split('\.', $previousEntry);
echo $pe_word . ' ' . $pe_num . '<br />';
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
		$words = $wordsLeft;
	}
}

if ($_GET['list']) {
?>
<form>
<input type="text" name="matches" style="width:40px"><input type="submit" name="submit" value="Go"><a href="fallout3.php">reset</a>
<input type="hidden" id="selected" name="selected">
<input type="hidden" id="previous" name="previous" value="<?php echo $previous ?>">
<input type="hidden" id="list" name="list" value="<?php echo $listNumber ?>">

<table>
<?php
		foreach ($words as $word) {
			?>
<tr>
	<td><a href="#" onclick="processWord('<?php echo $word ?>')"><?php echo $word ?></a></td>
	</tr>
<?php
				}
}		
?>
</table>
</form>
</body>
</html>
