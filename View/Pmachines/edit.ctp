<div class="pmachines form">
<?php echo $this->Form->create('Pmachine'); ?>
	<fieldset>
		<legend><?php echo __('Edit Physical machine'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('hostname');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
            <li><?php echo $this->Html->link(__('View Physical machine'), array('action' => 'view', $this->Form->value('Pmachine.id'))); ?> </li>
            <li><?php echo $this->Form->postLink(__('Delete Physical machine'), array('action' => 'delete', $this->Form->value('Pmachine.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Pmachine.id'))); ?></li>
            <li><?php echo $this->Html->link(__('List Physical machines'), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('New Physical machine'), array('action' => 'add')); ?> </li>		
	</ul>
</div>
<script>
  $(function() 
  {         
      $("#pmachines").css('background', '#D3D6FF');
  });   
  
</script>
