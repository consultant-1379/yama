<div class="menu">
<div class="leftmenu" style="float:left">    
    <ul id="menubar">
        <li id="LdapUsers"><?php echo $this->Html->link(__('Ldap Users'), array('controller' => 'adminusers','action' => 'index')); ?> </li>
        <li id="leases"><?php echo $this->Html->link(__('Leases'), array('controller' => 'leases', 'action' => 'index')); ?> </li>
        <li id="machinetypes"><?php echo $this->Html->link(__('Machine Types'), array('controller' => 'machine_types', 'action' => 'index')); ?> </li>		                                
        <li id="leasetypes"><?php echo $this->Html->link(__('Lease Types'), array('controller' => 'lease_types', 'action' => 'index')); ?> </li>		
        <li id="pmachines"><?php echo $this->Html->link(__('Physical machines'), array('controller' => 'pmachines', 'action' => 'index')); ?> </li>
        <li id="vapps"><?php echo $this->Html->link(__('Vapps'), array('controller' => 'vapps','action' => 'index')); ?> </li>
        <li id="vapptemplates"><?php echo $this->Html->link(__('Vapp Templates'), array('controller' => 'vapptemplates','action' => 'index')); ?> </li>
    </ul>
</div>
<div class="rightmenu" style="float:right">
    <ul id="menubar">
        <li id="logout"><?php echo $this->Html->link(__('Logout('.$current_user['username'].')' ), array('controller' => 'users','action' => 'logout')); ?> </li>
    </ul>
</div>
</div>


