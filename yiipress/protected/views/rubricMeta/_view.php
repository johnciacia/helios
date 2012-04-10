<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rubric_id')); ?>:</b>
	<?php echo CHtml::encode($data->rubric_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_label')); ?>:</b>
	<?php echo CHtml::encode($data->item_label); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_type')); ?>:</b>
	<?php echo CHtml::encode($data->item_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($data->position); ?>
	<br />


</div>