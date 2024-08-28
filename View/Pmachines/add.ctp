<div class="pmachines form">
<?php echo $this->Form->create('Pmachine'); ?>
	<fieldset>
		<legend><?php echo __('Add Physical machine'); ?></legend>
	<?php
		echo $this->Form->input('hostname');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>            
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