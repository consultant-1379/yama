<div class="vapps index">
	<h2><?php echo __('Vapps'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('vcd_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('state_id'); ?></th>
			<th><?php echo $this->Paginator->sort('vts_name'); ?></th>
			<th><?php echo $this->Paginator->sort('ip_address'); ?></th>
			<th><?php echo $this->Paginator->sort('org_vdc_id'); ?></th>
			<th><?php echo $this->Paginator->sort('team_id'); ?></th>
			<th><?php echo $this->Paginator->sort('citag_id'); ?></th>
			<th><?php echo $this->Paginator->sort('software_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('software_release_id'); ?></th>
			<th><?php echo $this->Paginator->sort('software_lsv_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_by_id'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('modified_by_id'); ?></th>
			<th><?php echo $this->Paginator->sort('deployed_from_id'); ?></th>
			<th><?php echo $this->Paginator->sort('shared'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($vapps as $vapp): ?>
	<tr>
		<td><?php echo h($vapp['Vapp']['id']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['vcd_id']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['name']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['description']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['state_id']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['vts_name']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['ip_address']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['org_vdc_id']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['team_id']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['citag_id']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['software_type_id']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['software_release_id']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['software_lsv_id']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['created']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['created_by_id']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['modified']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['modified_by_id']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['deployed_from_id']); ?>&nbsp;</td>
		<td><?php echo h($vapp['Vapp']['shared']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $vapp['Vapp']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vapp['Vapp']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vapp['Vapp']['id']), null, __('Are you sure you want to delete # %s?', $vapp['Vapp']['id'])); ?>
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
            <li><?php echo $this->Html->link(__('New Vapp'), array('action' => 'add')); ?> </li>		
	</ul>
</div>
<script>
  $(function() 
  {         
      $("#vapps").css('background', '#D3D6FF');
  });   
  
</script>