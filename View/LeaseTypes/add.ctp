<div class="leaseTypes form">
<?php echo $this->Form->create('LeaseType'); ?>
	<fieldset>
		<legend><?php echo __('Add Lease Type'); ?></legend>
	<?php
		echo $this->Form->input('lease_type_name');
		echo $this->Form->input('machine_type_id');
                echo $this->Form->input('lease_type_desc');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>                             
		<li><?php echo $this->Html->link(__('List Lease Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lease Type'), array('action' => 'add')); ?> </li>		
	</ul>
</div>
<script>
  $(function() 
  {         
      $("#leasetypes").css('background', '#D3D6FF');
  });   
  
</script>