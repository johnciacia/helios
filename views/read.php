<table class="table table-striped table-bordered table-condensed">
	<tr>
		<?php foreach( $headings as $column => $heading ) : ?>
		<?php if( $heading[0] == '' ) continue; ?>
		<th><?php echo $heading[0]; ?></th>
		<?php endforeach; ?>
	</tr>
<?php foreach( $items as $values ) : ?>
	<tr>
	<?php foreach( $values as $column => $item ) : ?>
		<?php if( $headings[$column][0] == '' ) continue; ?>
		<td><?php echo $item; ?></td>
	<?php endforeach; ?>
	<td><a href='?p=<?php echo $_GET['p']; ?>&q=edit&id=<?php echo $values['id']; ?>'>Edit</a></td>
	<td><a href='?p=<?php echo $_GET['p']; ?>&q=delete&id=<?php echo $values['id']; ?>'>Delete</a></td>
	</tr>
<?php endforeach; ?>
</table>
<a href="?p=<?php echo $_GET['p']; ?>&q=create" class="btn">Add New</a>