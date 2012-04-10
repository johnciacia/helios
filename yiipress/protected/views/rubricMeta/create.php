<?php
$this->breadcrumbs=array(
	'Rubric Metas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RubricMeta', 'url'=>array('index')),
	array('label'=>'Manage RubricMeta', 'url'=>array('admin')),
);
?>

<h1>Create RubricMeta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>