<?php
$this->breadcrumbs=array(
	'Rubric Metas',
);

$this->menu=array(
	array('label'=>'Create RubricMeta', 'url'=>array('create')),
	array('label'=>'Manage RubricMeta', 'url'=>array('admin')),
);
?>

<h1>Rubric Metas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
