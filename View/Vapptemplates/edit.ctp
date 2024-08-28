<div class="vapptemplates form">
<?php echo $this->Form->create('Vapptemplate'); ?>
	<fieldset>
		<legend><?php echo __('Edit Vapptemplate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('templateid');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
               <li><?php echo $this->Html->link(__('View Vapptemplate'), array('action' => 'view', $this->Form->value('Vapptemplate.id'))); ?> </li>               		
                <li><?php echo $this->Form->postLink(__('Delete Vapptemplate'), array('action' => 'delete', $this->Form->value('Vapptemplate.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Vapptemplate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Vapptemplates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vapptemplate'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<script>
  $(function() 
  {         
      $("#vapptemplates").css('background', '#D3D6FF');
  });   
  
</script>