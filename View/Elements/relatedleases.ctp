<div class="related">
	<h3><?php echo __('Related Leases'); ?></h3>
	<?php if (!empty($leases)): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Lease Type Id'); ?></th>
		<th><?php echo __('Expiry Date'); ?></th>
		<th><?php echo __('Remainders'); ?></th>
		<th><?php echo __('Machine Type Id'); ?></th>
		<th><?php echo __('Host Id'); ?></th>
                <th><?php echo __('Emails'); ?><th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($leases as $lease): ?>
		<tr>			
                        <td><?php echo $lease['id']; ?></td>
                        <td><?php echo $this->Html->link($lease['LeaseType']['lease_type_name'], array('controller' => 'lease_types', 'action' => 'view', $lease['LeaseType']['id'])); ?></td>			
			<td><?php echo $lease['expiry_date']; ?></td>
			<td><?php echo $lease['remainders']; ?></td>			
                        <td><?php echo $this->Html->link($lease['MachineType']['machine_type_name'], array('controller' => 'machine_types', 'action' => 'view', $lease['MachineType']['id'])); ?></td>
			<td><?php echo $lease['host_id']; ?></td>
                        <td><?php echo $lease['emails']; ?></td>
                        <?php echo $this->element('leaseactions',array(
                             'machine_type_id' => $lease['machine_type_id'],
                             'hostid' => $lease['host_id'],
                             'leaseid' => $lease['id'],
                            )); ?>			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>			
                        <li><?php echo $this->Html->link(__('New Lease'), array('controller' => 'leases', 'action' => 'addsp',$machine_type_id,$hostid)); ?> </li>
		</ul>
	</div>
</div>