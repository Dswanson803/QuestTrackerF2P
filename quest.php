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
			
			//Add quest to your list.
			if (isset($_POST["addQuest"])) {
				
				addQuest($_POST["addQuest"]);
				
			}
		}
		
		//Display quest table.
		questList();
			
	?>	
	
</table>

<?php
require("footer.php");