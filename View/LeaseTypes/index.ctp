<div class="leaseTypes index">
	<h2><?php echo __('Lease Types'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('lease_type_name'); ?></th>
			<th><?php echo $this->Paginator->sort('machine_type_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('lease_type_desc'); ?></th>                        
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($leaseTypes as $leaseType): ?>
	<tr>
		<td><?php echo h($leaseType['LeaseType']['id']); ?>&nbsp;</td>
		<td><?php echo h($leaseType['LeaseType']['lease_type_name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($leaseType['MachineType']['machine_type_name'], array('controller' => 'machine_types', 'action' => 'view', $leaseType['MachineType']['id'])); ?>
		</td>
                <td><?php echo h($leaseType['LeaseType']['lease_type_desc']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $leaseType['LeaseType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $leaseType['LeaseType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $leaseType['LeaseType']['id']), null, __('Are you sure you want to delete # %s?', $leaseType['LeaseType']['id'])); ?>
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
            <li><?php echo $this->Html->link(__('New Lease Type'), array('action' => 'add')); ?> </li>		
	</ul>
</div>
<script>
  $(function() 
  {         
      $("#leasetypes").css('background', '#D3D6FF');
  });   
  
</script>