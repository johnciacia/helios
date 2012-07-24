<form method="post" class="well form-horizontal">
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="teacher_id">Teacher</label>
			<div class="controls"><input type="text" name="teacher_id" class="span4" /><br /></div>
		</div>

		<div class="control-group">
			<label class="control-label" for="date">Date</label>
			<div class="controls"><input type="text" name="date" class="span4" /><br /></div>
		</div>
	<fieldset>

	<table class="table table-striped table-bordered table-condensed">
		<tr>
			<th></th>
			<th>Standard</th>
			<th>Element</th>
			<th>Indicator</th>
		</tr>
		<?php foreach( $standards as $standard ) : ?>
			<?php $elements = $this->element_model->getElementsByStandard( $standard->id ); ?>
				<?php foreach( $elements as $element ) : ?>
					<?php $indicators = $this->indicator_model->getIndicatorsByElement( $element['id'] ); ?>
					<?php foreach( $indicators as $indicator ) : ?>
						<tr>
							<td><input type="checkbox" name="indicators[]" value="<?php echo $indicator['id']; ?>" /></td>
							<td><?php echo $standard->title; ?></td>
							<td><?php echo $element['title']; ?></td>
							<td><?php echo $indicator['desc']; ?></td>
						</tr>
					<?php endforeach; ?>
				<?php endforeach ?>
		<?php endforeach; ?>
	</table>

	<div class="form-actions">
		<input type="submit" class="btn btn-primary" />
	</div>
</form>