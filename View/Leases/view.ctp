<div class="leases view">
<h2><?php  echo __('Lease'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lease['Lease']['id']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Machine Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lease['MachineType']['machine_type_name'], array('controller' => 'machine_types', 'action' => 'view', $lease['MachineType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Host'); ?></dt>
		<dd>			
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
                        &nbsp;
		</dd>
		<dt><?php echo __('Lease Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lease['LeaseType']['lease_type_name'], array('controller' => 'lease_types', 'action' => 'view', $lease['LeaseType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expiry Date'); ?></dt>
		<dd>
			<?php echo h($lease['Lease']['expiry_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remainders'); ?></dt>
		<dd>
			<?php echo h($lease['Lease']['remainders']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Emails'); ?></dt>
		<dd>
			<?php echo h($lease['Lease']['emails']); ?>
			&nbsp;
		</dd>
		
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lease'), array('action' => 'edit', $lease['Lease']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lease'), array('action' => 'delete', $lease['Lease']['id']), null, __('Are you sure you want to delete # %s?', $lease['Lease']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Leases'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lease'), array('action' => 'add')); ?> </li>		
	</ul>
</div>
<script>
  $(function() 
  {         
      $("#leases").css('background', '#D3D6FF');
  });   
  
</script>
