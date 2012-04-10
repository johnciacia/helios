<?php
$this->breadcrumbs=array(
	'Rubrics'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Rubric', 'url'=>array('index')),
	array('label'=>'Create Rubric', 'url'=>array('create')),
	array('label'=>'Update Rubric', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Rubric', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Rubric', 'url'=>array('admin')),
);
?>

<h1>View Rubric #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'title',
	),
)); ?>
