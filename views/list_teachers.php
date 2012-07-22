<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Teacher ID</th>
		<th colspan="2"></th>
	</tr>
<?php
foreach( $teachers as $teacher ) {
	echo "<tr>";
	echo "<td>" . $teacher['first_name'] . "</td>";
	echo "<td>" . $teacher['last_name'] . "</td>";
	echo "<td>" . $teacher['teach_id'] . "</td>";
	echo "<td><a href='?p=teacher&q=edit&id={$teacher['id']}'>Edit</a></td>";
	echo "<td><a href='?p=teacher&q=delete&id={$teacher['id']}'>Delete</a></td>";
	echo "</tr>";
}
?>
</table>
<a href="?p=teacher&q=add" class="btn">Add New</a>