<form method="post" class="well form-horizontal">
	<fieldset>
		<?php foreach( $items as $id => $item ) : ?>
		<?php if( $item[0] == 0 ) continue; ?>
		<div class="control-group">
			<label class="control-label" for="<?php echo $id; ?>">
				<?php echo $item[1]; ?>
			</label>

			<div class="controls">
				<?php echo input_type( $item, $id ); ?><br />
			</div>
		</div>
		<?php endforeach; ?>

		<div class="form-actions">
			<input type="submit" class="btn btn-primary" />
		</div>
	</fieldset>
</form>