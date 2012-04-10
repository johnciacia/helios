<?php
$this->breadcrumbs=array(
	'Rubrics',
);

$this->menu=array(
	array('label'=>'Create Rubric', 'url'=>array('create')),
	array('label'=>'Manage Rubric', 'url'=>array('admin')),
);
?>

<h1>Rubrics</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
