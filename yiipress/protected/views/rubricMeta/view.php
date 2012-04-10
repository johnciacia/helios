<?php
$this->breadcrumbs=array(
	'Rubric Metas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RubricMeta', 'url'=>array('index')),
	array('label'=>'Create RubricMeta', 'url'=>array('create')),
	array('label'=>'Update RubricMeta', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RubricMeta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RubricMeta', 'url'=>array('admin')),
);
?>

<h1>View RubricMeta #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'rubric_id',
		'item_label',
		'item_type',
		'position',
	),
)); ?>
