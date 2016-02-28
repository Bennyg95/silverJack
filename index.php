<!DOCTYPE html>
<html>
    <head>
        <title> Silverjack </title>
        <meta charset="utf-8"/>
        <link href="https://preview.c9users.io/clarissa_vazquez/cst336/Labs/Lab 3/CSS/index.css" rel="stylesheet"/>
    </head>
    <body>
        <header>
            <h1>Silverjack</h1>
        </header>   
           
           
        <?=main()?>
        <div>
            <input id="button" type="button" value="Play Again!" onClick="window.location.reload()" class="button">
        </div>
        
        <!-- footer is for our csumb logo -->
        <footer>
            
        </footer>
    </body>
</html>
<?php

function main() {
    $deck = array();
    $scores = array();
    for($i = 1; $i <= 52; $i++) {
	$deck[] = $i;
    }
    shuffle($deck);
    echo "<table size='50%'>";
	echo "<tr>";

	    $temp = getHand($deck, $scores);
	    echo "<td>";
		echo "<img src='silverJack/img/faces/ricardo.png' width='20%' alt='Ricky'/>";
		displayHand($temp);
	    echo "</td>";
	    echo "<td>";
		playersPoints($scores, 0);
	    echo "</td>";

	echo "</tr>";

	echo "<tr>";

	    $fallas = getHand($deck, $scores);
	    echo "<td>";
		echo "<img src='silverJack/img/faces/benito.jpg' width='20%' alt='Benito'/>";
		displayHand($fallas);
	    echo "</td>";
	    echo "<td>";
		playersPoints($scores, 1);
	    echo "</td>";

	echo "</tr>";

	echo "<tr>";

	    $temp = getHand($deck, $scores);
	    echo"<td>";
		echo "<img src='silverJack/img/faces/stephen.jpg' width='20%' alt='Stephen' />";
		displayHand($temp);
	    echo "</td>";
	    echo "<td>";

		playersPoints($scores, 2);

	    echo "</td>";

	echo "</tr>";

	echo "<tr>";

	    $temp = getHand($deck, $scores);
	    echo "<td>";
		echo "<img src='silverJack/img/faces/clarissa.jpg' width='20%' alt='Clarissa'/>";
		displayHand($temp);
	    echo "</td>";
	    echo "<td>";
		playersPoints($scores, 3);
	    echo "</td>";
	echo "</tr>";

    echo "</table>";

    echo "<br/>";
    echo "<div id='winners'>";
    displayWinners($scores);
    echo "</div>";
}

function getHand(&$deck, &$scores) {
    global $hand;
    $done = false;
    $sum = 0;
    unset($hand);
    $hand = array();
    while(! $done) {
	$choice = rand(0, 1);
	if($sum < 36) {
	    $card = array_pop($deck);
	    if($card == 52)
		$card--;
	    $cardValue = $card % 13;
	    if($cardValue == 0)
		$cardValue = 13;

	    array_push($hand, $card);
	    $sum = $sum + $cardValue;
	}
	else if($sum < 42 && $choice == 1) {
	    $card = array_pop($deck);
	    if($card == 52)
		$card--;
	    $cardValue = $card % 13;
	    if($cardValue == 0)
	    {
		$cardValue = 13;
	    }

	    array_push($hand, $card);
	    $sum = $sum + $cardValue;

	}


	else {
	    array_push($scores, $sum);
	    $done = true;
	}
    }

    return($hand);
}

function displayHand($hand)
{
    $size = sizeof($hand);
    for($i = 0; $i < $size; $i++) {
        $suit = array("clubs", "diamonds", "hearts", "spades");
        $card = array_pop($hand);
        if($card == 52)
            $card--;
        $cardSuit = $suit[floor($card / 13)];
        $cardValue = $card % 13;
        if($cardValue == 0)
            $cardValue = 13;
            
        echo "<img src=cards/$cardSuit/$cardValue.png>  ";
    }
}

function displayWinners(&$scores) {
    $winners = array();

    $greatestIndex = 0;
    if($scores[$greatestIndex] > 42) {
	do{
	    $greatestIndex++;
	}while(($scores[$greatestIndex] > 42) && ($greatestIndex < sizeof($scores)));
    }
    // 41 47 37 44
    for($currIndex = $greatestIndex; $currIndex < sizeof($scores); $currIndex++) {
	if($scores[$currIndex] <= 42) {
	    if($scores[$currIndex] > $scores[$greatestIndex]) {
		unset($winners);
		$winners = array();
		$winners[] = $currIndex;
		$greatestIndex = $currIndex;
	    }
	    else if($scores[$currIndex] == $scores[$greatestIndex]){
		$winners[] = $currIndex;

	    }
	}
    }

    $names = array("Ricky", "Benito", "Stephen", "Clarissa");

    if(sizeof($winners) == 1) {
	$points = array_sum($scores) - $scores[$winners[0]];
	echo $names[$winners[0]] . " Wins " . $points . " points!";
    }
    else {
	echo "TIE!";
    }
}

?>