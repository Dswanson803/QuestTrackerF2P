<?php
require("header.php");
?>
<div class="quest-img"></div>
<h2 class="table-header">Free to Play</h2>
<table>
	<tr>
		<th>Name</th>
		<th>Quest Points</th>
		<th>Location</th>
	</tr>
	
	<?php
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			
			//Remove quest to your list.
			if (isset($_POST["removeQuest"])) {
				
				removeQuest($_POST["removeQuest"]);
				
			}
		}
		
		//Display user's list in a table.
		showQuests();
		questPoints();
	?>	

</table>
	
<?php
require("footer.php");