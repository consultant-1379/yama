<div class="leaseTypes form">
<?php echo $this->Form->create('LeaseType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Lease Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
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
                <li><?php echo $this->Html->link(__('View Lease Type'), array('action' => 'view', $this->Form->value('LeaseType.id'))); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lease Type'), array('action' => 'delete', $this->Form->value('LeaseType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('LeaseType.id'))); ?></li>
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
