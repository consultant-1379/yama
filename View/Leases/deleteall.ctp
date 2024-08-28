<div class="leases form">
<?php echo $this->Form->create('Lease'); ?>
	<fieldset>
		<legend><?php echo __('Delete Leases'); ?></legend>
                <?php		
                    echo $this->Form->input('expiry_date');
                 ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
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
