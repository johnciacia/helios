<table class="table table-striped table-bordered table-condensed">
	<tr>
		<?php foreach( $items as $column => $item ) : ?>
		<?php if( false === $item['display'] ) continue; ?>
		<th><?php echo $item['label']; ?></th>
		<?php endforeach; ?>
		<th colspan="2"></th>
	</tr>

	<?php foreach( $values as $value ) : ?>
	<tr>
		<?php foreach( $value->items as $column => $item ) : ?>
			<?php if( $items[$column]['display'] === false ) continue; ?>
			<td><?php 
			if( isset( $item['cb_display'] ) )
				echo call_user_func_array( $item['cb_display'], array( $item['value'] ) );
			else
				echo $item['value']; ?></td>
		<?php endforeach; ?>
		<td><a href='?p=<?php echo $_GET['p']; ?>&q=update&id=<?php echo $value->id; ?>'>Edit</a></td>
		<td><a href='?p=<?php echo $_GET['p']; ?>&q=delete&id=<?php echo $value->id; ?>'>Delete</a></td>
	</tr>
	<?php endforeach; ?>
</table>
<a href="?p=<?php echo $_GET['p']; ?>&q=create" class="btn">Add New</a>