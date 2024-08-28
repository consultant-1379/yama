<div class="machineTypes form">
<?php echo $this->Form->create('MachineType'); ?>
	<fieldset>
		<legend><?php echo __('Add Machine Type'); ?></legend>
	<?php
		echo $this->Form->input('machine_type_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>                             
		
		<li><?php echo $this->Html->link(__('List Machine Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Machine Type'), array('action' => 'add')); ?> </li>		
	</ul>
</div>
<script>
  $(function() 
  {         
      $("#machinetypes").css('background', '#D3D6FF');
  });   
  
</script>