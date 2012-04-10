<?php
$this->breadcrumbs=array(
	'Rubrics'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Rubric', 'url'=>array('index')),
	array('label'=>'Manage Rubric', 'url'=>array('admin')),
);
?>

<h1>Create Rubric</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>