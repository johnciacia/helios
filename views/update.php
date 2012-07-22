<form method="post" class="well form-horizontal">
	<fieldset>
		<?php foreach( $items as $id => $item ) : ?>
		<?php if( $item[0] == '' ) continue; ?>
		<div class="control-group">
			<label class="control-label" for="<?php echo $id; ?>">
				<?php echo $item[0]; ?>
			</label>

			<div class="controls">
				<?php if( $item[1] == 'text') : ?>
					<input type="text" name="<?php echo $id; ?>" class="span4" value=<?php echo $item['value']; ?> /><br />
				<?php elseif( $item[1] == 'textarea') : ?>
					<textarea name="<?php echo $id; ?>" class="span6"><?php echo $item['value']; ?></textarea><br />
				<?php endif; ?>
			</div>
		</div>
		<?php endforeach; ?>

		<div class="form-actions">
			<input type="submit" class="btn btn-primary" />
		</div>
	</fieldset>
</form>