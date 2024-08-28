<td class="actions">
    <?php echo $this->Html->link(__('View'), array('controller' => 'leases', 'action' => 'view', $leaseid)); ?>
    <?php echo $this->Html->link(__('Edit'), array('controller' => 'leases', 'action' => 'editsp',$machine_type_id,$hostid, $leaseid)); ?>
    <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'leases', 'action' => 'deletesp',$machine_type_id,$hostid, $leaseid), null, __('Are you sure you want to delete # %s?', $leaseid)); ?>
</td>