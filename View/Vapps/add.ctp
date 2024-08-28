<div class="vapps form">
<?php echo $this->Form->create('Vapp'); ?>
	<fieldset>
		<legend><?php echo __('Add Vapp'); ?></legend>
	<?php
		echo $this->Form->input('vcd_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('state_id');
		echo $this->Form->input('vts_name');
		echo $this->Form->input('ip_address');
		echo $this->Form->input('org_vdc_id');
		echo $this->Form->input('team_id');
		echo $this->Form->input('citag_id');
		echo $this->Form->input('software_type_id');
		echo $this->Form->input('software_release_id');
		echo $this->Form->input('software_lsv_id');
		echo $this->Form->input('created_by_id');
		echo $this->Form->input('modified_by_id');
		echo $this->Form->input('deployed_from_id');
		echo $this->Form->input('shared');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>           
            <li><?php echo $this->Html->link(__('List Vapps'), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('New Vapp'), array('action' => 'add')); ?> </li>		
	</ul>
</div>
<script>
  $(function() 
  {         
      $("#vapps").css('background', '#D3D6FF');
  });   
  
</script>