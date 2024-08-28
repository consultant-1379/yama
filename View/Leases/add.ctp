<div class="leases form">
<?php echo $this->Form->create('Lease'); ?>
	<fieldset>
		<legend><?php echo __('Add Lease'); ?></legend>
	<?php
		echo $this->Form->input('machine_type_id');
                echo $this->Form->input('host_id');
                echo $this->Form->input('lease_type_id');
		echo $this->Form->input('expiry_date');
		echo $this->Form->input('remainders');	
                echo $this->Form->input('emails');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>	
		<li><?php echo $this->Html->link(__('List Leases'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lease'), array('action' => 'add')); ?> </li>		
	</ul>
</div>

<?php
$this->Js->get('#LeaseMachineTypeId')->event('change', 
	$this->Js->request(array(
		'controller'=>'hosts',
		'action'=>'getHosts'
		), array(
		'update'=>'#LeaseHostId',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			))
		))
	);

$this->Js->get('#LeaseMachineTypeId')->event('change', 
	$this->Js->request(array(
		'controller'=>'lease_types',
		'action'=>'getByMachineType'
		), array(
		'update'=>'#LeaseLeaseTypeId',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			))
		))
	);
?>
<script>
  $(function() 
  {         
      $("#leases").css('background', '#D3D6FF');
  });   
  
</script>