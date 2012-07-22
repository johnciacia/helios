<form method="post">
	First Name: <input type="text" name="first_name" value="<?php echo $first_name; ?>" /><br />
	Last Name: <input type="text" name="last_name" value="<?php echo $last_name; ?>" /><br />
	Teacher ID: <input type="text" name="teach_id" value="<?php echo $teach_id; ?>" /><br />
	<input type="hidden" value="update-teacher" name="action" />
	<input type="submit" />
</form>