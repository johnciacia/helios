<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('li.standard, li.element').live('click', function(e) { 
			if(e.srcElement == e.currentTarget) {
				$('> ul', this).toggle();
				e.stopPropagation();	
			}
			
		});
	});
</script>
<form method="post">
<ul>
<?php
foreach( $standards as $standard ) {
	echo "<li class='standard' data-id='".$standard['id']."'>" . $standard['title'];
	$elements = $model->get_elements( $standard['id'] );
	echo "<ul>";
	foreach( $elements as $element ) {
		echo "<li class='element' data-id='".$element['id']."'>" . $element['title'];
		$indicators = $model->get_indicators( $element['id'] );
		echo "<ul>";
		foreach( $indicators as $indicator ) {
			echo "<li class='indicator'><input type='checkbox' name='indicators[]' value='".$indicator['id']."' />" . $indicator['title'];
		}
		echo "</ul>";
	}
	echo "</ul>";
	echo "</li>";
}
?>
</ul>
<input type="submit" />
</form>