<div class="vapps view">
<h2><?php  echo __('Vapp'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vcd Id'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['vcd_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State Id'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['state_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vts Name'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['vts_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ip Address'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['ip_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Org Vdc Id'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['org_vdc_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team Id'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['team_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Citag Id'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['citag_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Software Type Id'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['software_type_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Software Release Id'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['software_release_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Software Lsv Id'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['software_lsv_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By Id'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['created_by_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By Id'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['modified_by_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deployed From Id'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['deployed_from_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shared'); ?></dt>
		<dd>
			<?php echo h($vapp['Vapp']['shared']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vapp'), array('action' => 'edit', $vapp['Vapp']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vapp'), array('action' => 'delete', $vapp['Vapp']['id']), null, __('Are you sure you want to delete # %s?', $vapp['Vapp']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Vapps'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vapp'), array('action' => 'add')); ?> </li>		
	</ul>
</div>
<?php 
$machine_types=Configure::read('MachineTypes');
echo $this->element('relatedleases',array(
                             'leases' => $vapp['Lease'],
                             'machine_type_id' => $machine_types['VAPP'],
                             'hostid' => $vapp['Vapp']['id']   
                            )); ?>
<script>
  $(function() 
  {         
      $("#vapps").css('background', '#D3D6FF');
  });   
  
</script>