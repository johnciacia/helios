<?php
$this->breadcrumbs=array(
	'Rubrics'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Rubric', 'url'=>array('index')),
	array('label'=>'Create Rubric', 'url'=>array('create')),
	array('label'=>'View Rubric', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Rubric', 'url'=>array('admin')),
);
?>

<h1>Update Rubric <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>