<div class="leases index">
	<h2><?php echo __('Leases'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('lease_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('expiry_date'); ?></th>
			<th><?php echo $this->Paginator->sort('remainders'); ?></th>
			<th><?php echo $this->Paginator->sort('machine_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('host_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('emails'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($leases as $lease): ?>
	<tr>
		<td><?php echo h($lease['Lease']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($lease['LeaseType']['lease_type_name'], array('controller' => 'lease_types', 'action' => 'view', $lease['LeaseType']['id'])); ?>
		</td>
		<td><?php echo h($lease['Lease']['expiry_date']); ?>&nbsp;</td>
		<td><?php echo h($lease['Lease']['remainders']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($lease['MachineType']['machine_type_name'], array('controller' => 'machine_types', 'action' => 'view', $lease['MachineType']['id'])); ?>
		</td>
<!--		<td>
			<!--?php echo $this->Html->link($lease['Pmachine']['hostname'], array('controller' => 'pmachines', 'action' => 'view', $lease['Pmachine']['id'])); ?-->
		<!--/td>-->
                <td>                    
                    <?php 
                        $machine_types=Configure::read('MachineTypes');
                        if($lease['MachineType']['id'] == $machine_types['VAPP'])
                            if(isset($lease['Lease']['host']['Vapp']))
                                echo $this->Html->link($lease['Lease']['host']['Vapp']['name'], array('controller' => 'vapps', 'action' => 'view', $lease['Lease']['host_id'])); 
                            else
                                echo $this->Html->div('missinghost', 'Vapp does not exist');
                        else if($lease['MachineType']['id'] == $machine_types['PHYSICAL'])
                            echo $this->Html->link($lease['Lease']['host']['Pmachine']['hostname'], array('controller' => 'pmachines', 'action' => 'view', $lease['Lease']['host_id'])); 
                        else if($lease['MachineType']['id'] == $machine_types['VAPPTEMP'])
                            if(isset($lease['Lease']['host']['Vapptemplate']))
                                echo $this->Html->link($lease['Lease']['host']['Vapptemplate']['name'], array('controller' => 'vapptemplates', 'action' => 'view', $lease['Lease']['host_id'])); 
                            else
                                echo $this->Html->div('missinghost', 'Vapptemplate does not exist');
                    ?>
                </td>
                <td><?php echo h($lease['Lease']['emails']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $lease['Lease']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $lease['Lease']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $lease['Lease']['id']), null, __('Are you sure you want to delete # %s?', $lease['Lease']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>		
		<li><?php echo $this->Html->link(__('New Lease'), array('action' => 'add')); ?> </li>		
                <li><?php echo $this->Html->link(__('Delete old Leases'), array('action' => 'deleteall')); ?> </li>	                
	</ul>
</div>
<script>
  $(function() 
  {         
      $("#leases").css('background', '#D3D6FF');
  });   
  
</script>