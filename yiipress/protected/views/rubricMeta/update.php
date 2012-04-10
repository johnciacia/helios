<?php
$this->breadcrumbs=array(
	'Rubric Metas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RubricMeta', 'url'=>array('index')),
	array('label'=>'Create RubricMeta', 'url'=>array('create')),
	array('label'=>'View RubricMeta', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RubricMeta', 'url'=>array('admin')),
);
?>

<h1>Update RubricMeta <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>