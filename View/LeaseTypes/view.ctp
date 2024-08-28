<div class="leaseTypes view">
<h2><?php  echo __('Lease Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($leaseType['LeaseType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lease Type Name'); ?></dt>
		<dd>
			<?php echo h($leaseType['LeaseType']['lease_type_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Machine Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($leaseType['MachineType']['machine_type_name'], array('controller' => 'machine_types', 'action' => 'view', $leaseType['MachineType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lease Type Desc'); ?></dt>
		<dd>
			<?php echo h($leaseType['LeaseType']['lease_type_desc']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lease Type'), array('action' => 'edit', $leaseType['LeaseType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lease Type'), array('action' => 'delete', $leaseType['LeaseType']['id']), null, __('Are you sure you want to delete # %s?', $leaseType['LeaseType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lease Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lease Type'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Leases'); ?></h3>
	
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Lease Type Id'); ?></th>
		<th><?php echo __('Expiry Date'); ?></th>
		<th><?php echo __('Remainders'); ?></th>
		<th><?php echo __('Machine Type Id'); ?></th>
		<th><?php echo __('Host Id'); ?></th>
		<th><?php echo __('Emails'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($leases as $lease): ?>
		<tr>
			<td><?php echo $lease['Lease']['id']; ?></td>
			<td><?php echo $lease['Lease']['lease_type_id']; ?></td>
			<td><?php echo $lease['Lease']['expiry_date']; ?></td>
			<td><?php echo $lease['Lease']['remainders']; ?></td>
			<td><?php echo $lease['Lease']['machine_type_id']; ?></td>
			<td><?php echo $lease['Lease']['host_id']; ?></td>
			<td><?php echo $lease['Lease']['emails']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'leases', 'action' => 'view', $lease['Lease']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'leases', 'action' => 'edit', $lease['Lease']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'leases', 'action' => 'delete', $lease['Lease']['id']), null, __('Are you sure you want to delete # %s?', $lease['Lease']['id'])); ?>
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


	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Lease'), array('controller' => 'leases', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<script>
  $(function() 
  {         
      $("#leasetypes").css('background', '#D3D6FF');
  });   
  
</script>