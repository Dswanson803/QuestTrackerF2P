<?php
session_start();

//Checks a session exists.
if(!isset($_SESSION["ip"]))
{
	$_SESSION["ip"] = $_SERVER["REMOTE_ADDR"];	
}
else
{
	if($_SESSION["ip"] == $_SERVER["REMOTE_ADDR"])
	{
		// :)
	}	
	else {
		//HACKER PLS NO
		session_destroy();
		$_SESSION = array();
		session_write_close();
		header("Location: login.php");
		exit();
	}
}

//Returns the quest information from quest.txt
function readLines() 
{
	$quest = fopen("quest.txt", "r");
	if(!is_resource($quest)) 
	{
		//HACKER STOP, or I forgot to chmod.
		exit("Error, file missing.");
	}
	$questList = array();
	while($line  = fgets($quest)) 
	{
		$questList[] = $line;
	}
	fclose($quest);
	return $questList;
}

//echos the list of quests in a table.
function questList() {
	
	$quests = readLines();
	
	//check if user is logged in.
	if (isset($_SESSION["username"])) {
		
		//explode quest.txt, and output in table.
		foreach($quests as $lineNo => $line) {
			
			//BOOM
			$line = explode("|", $line);
			
			//Table Time
			echo "<tr>";
			
			//iterates through the array $line.
			for ($x = 0; $x <= 2; $x++) {
				if($x == 1) {
						
					//Applying class to the second column.
					echo "<td class='qp'>" . $line[$x] . "</td>";
					
				} else {
					
					echo "<td>" . $line[$x] . "</td>";			
							
				}
				
			}
			echo "<td>";
			echo "<form method='post' action='quest.php'>";
			echo "<input type=\"hidden\" name=\"addQuest\" value=\"$lineNo\">";
			echo "<button type='submit' class='add-button'>Add</button>";
			echo "</form>";
			echo "</td>";
			echo "</tr>";
		}
		
	} else {
		echo "<h2>Please login to begin questing.";
	}
}

//Adds the selected quest to user's list.
function addQuest($questId) {
	
	//Checks to see if the quest list already exists.
	if(isset($_SESSION["questList"])) {
		
		//Checks to see if the quest is already in the list.
		if(!in_array($questId, $_SESSION["questList"])) {
			
			//Adds the quest to the user's quest list.
			$_SESSION["questList"][] = $questId;
			
		}
		
	} else {
			
			//Creates the quest list.
			$_SESSION["questList"] = array();
			
			//Adds the quest to the user's list.
			$_SESSION["questList"][] = $questId;
			
	}
}

function showQuests() {
	
	//Checks if the quest list is created.
	if(isset($_SESSION["questList"]) & !empty($_SESSION["questList"])) {
		
		$quests = readLines();
		
		foreach($_SESSION["questList"] as $id) {
			
			
			//BOOM 2.0
			$line = explode("|", $quests[$id]);
			
			//Table Time
			echo "<tr>";
			
			//iterates through the array $line.
			for ($x = 0; $x <= 2; $x++) {
				if($x == 1) {
						
					//Applying class to the second column.
					echo "<td class='qp'>" . $line[$x] . "</td>";
					
				} else {
					
					echo "<td>" . $line[$x] . "</td>";			
							
				}
				
			}
			echo "<td>";
			echo "<form method='post' action='list.php'>";
			echo "<input type=\"hidden\" name=\"removeQuest\" value=\"$id\">";
			echo "<button type='submit' class='add-button'>Remove</button>";
			echo "</form>";
			echo "</td>";
			echo "</tr>";
			
		}
		
	} else {
		
		echo "<span style='text-align: center; width: 75%;'><h2>You have not added any quests to your quest list.</h2></span>";
		
	}
	
}

//Removes a quest from the user's list.
function removeQuest($id) {
	
	//Search the user's list for the given quest.
	$key = array_search($id, $_SESSION["questList"]);
	
	//Removes the quest from the user's list.
	unset($_SESSION["questList"][$key]);
	
}

//Calculates the quest points rewarded for user's list.
function questPoints() {
	
	//Checks if quest list exists.
	if(isset($_SESSION["questList"]) & !empty($_SESSION["questList"])) {
		
		//sum of quest points.
		$points = 0;
		
		$quests = readLines();
		
		foreach($_SESSION["questList"] as $id) {
			
			//BOOM 3.0
			$line = explode("|", $quests[$id]);
			
			$points += $line[1];
			
		}
		
		echo "<tr><td class='total'>Total:</td>";
		echo "<td class='sum'>" . $points . "</td></tr>";
		
	} 
	
}
