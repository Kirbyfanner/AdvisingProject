<?php
/* Updated by Dan S. */
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Create New Admin</title>
    <link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h2>
		<?php
		
		if (!$_SESSION["Exists"])
		{
			echo 'New Advisor has been created:';
		}
		else
		{
			echo 'New Advisor already exists';
		}
		$_SESSION["Exists"] = false;
		?>
		</h2>
		
		<!-- Back to UI -->
		<form method="link" action="AdminUI.php">
			<input type="submit" name="next" class="button large go" value="Return to Home">
		</form>
	</div>
	</div>
	</div>
	</form>
  </body>
  <?php include("footer.html"); ?>
</html>
