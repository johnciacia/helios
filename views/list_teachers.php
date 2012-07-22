<a href="?p=teacher&q=add">Add New</a>
<table>
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Teacher ID</th>
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