<div class="adminusers view">
<h2><?php  echo __('Ldap User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($adminuser['Adminuser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Signumid'); ?></dt>
		<dd>
			<?php echo h($adminuser['Adminuser']['signumid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($adminuser['Adminuser']['Description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ldap User'), array('action' => 'edit', $adminuser['Adminuser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ldap User'), array('action' => 'delete', $adminuser['Adminuser']['id']), null, __('Are you sure you want to delete # %s?', $adminuser['Adminuser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ldap Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ldap User'), array('action' => 'add')); ?> </li>
	</ul>
</div>
