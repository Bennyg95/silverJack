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

?>