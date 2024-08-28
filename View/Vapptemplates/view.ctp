<div class="vapptemplates view">
<h2><?php  echo __('Vapptemplate'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vapptemplate['Vapptemplate']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($vapptemplate['Vapptemplate']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Templateid'); ?></dt>
		<dd>
			<?php echo h($vapptemplate['Vapptemplate']['templateid']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vapptemplate'), array('action' => 'edit', $vapptemplate['Vapptemplate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vapptemplate'), array('action' => 'delete', $vapptemplate['Vapptemplate']['id']), null, __('Are you sure you want to delete # %s?', $vapptemplate['Vapptemplate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Vapptemplates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vapptemplate'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<?php 
$machine_types=Configure::read('MachineTypes');
echo $this->element('relatedleases',array(
                             'leases' => $vapptemplate['Lease'],
                             'machine_type_id' => $machine_types['VAPPTEMP'],
                             'hostid' => $vapptemplate['Vapptemplate']['id'],                             
                            )); ?>			
<script>
  $(function() 
  {         
      $("#vapptemplates").css('background', '#D3D6FF');
  });   
  
</script>