<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Leases'), array('controller' => 'leases', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Machine Types'), array('controller' => 'machine_types', 'action' => 'index')); ?> </li>		                                
        <li><?php echo $this->Html->link(__('Lease Types'), array('controller' => 'lease_types', 'action' => 'index')); ?> </li>		
        <li><?php echo $this->Html->link(__('Physical machines'), array('controller' => 'pmachines', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Vapps'), array('controller' => 'vapps','action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Vapp Templates'), array('controller' => 'vapptemplates','action' => 'index')); ?> </li>
    </ul>
</div>
