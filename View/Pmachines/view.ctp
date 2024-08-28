<div class="pmachines view">
<h2><?php  echo __('Physical machine'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pmachine['Pmachine']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hostname'); ?></dt>
		<dd>
			<?php echo h($pmachine['Pmachine']['hostname']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Physical machine'), array('action' => 'edit', $pmachine['Pmachine']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Physical machine'), array('action' => 'delete', $pmachine['Pmachine']['id']), null, __('Are you sure you want to delete # %s?', $pmachine['Pmachine']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Physical machines'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Physical machine'), array('action' => 'add')); ?> </li>		
	</ul>
</div>
<?php 
$machine_types=Configure::read('MachineTypes');
echo $this->element('relatedleases',array(
                             'leases' => $pmachine['Lease'],
                             'machine_type_id' => $machine_types['PHYSICAL'],
                             'hostid' => $pmachine['Pmachine']['id']   
                            )); ?>
<script>
  $(function() 
  {         
      $("#pmachines").css('background', '#D3D6FF');
  });   
  
</script>
