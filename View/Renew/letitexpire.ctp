<?php 
$this->layout='renew';
?>
<div class="renew">
    <h2><?php  echo __('Lease Expiry accepted'); ?></h2>
    Lease for the Machine: 
    <span style="color:brown">
    <?php $machine_types=Configure::read('MachineTypes');
    if($lease['MachineType']['id'] == $machine_types['VAPP']): ?>
        <?php echo $lease['Lease']['host']['Vapp']['vts_name'];  ?>
    <?php elseif($lease['MachineType']['id'] == $machine_types['PHYSICAL']): ?>
        <?php echo $lease['Lease']['host']['Pmachine']['hostname'];  ?>
    <?php elseif($lease['MachineType']['id'] == $machine_types['VAPPTEMP']): ?>
        <?php echo $lease['Lease']['host']['Vapptemplate']['name'];?>
    <?php endif ?></span>	
      will expire on <span style="color:brown"><?php echo $lease['Lease']['expiry_date'] ?></span>.
      and no reminder mails will be sent.When the lease expires, <?php echo $lease['LeaseType']['lease_type_desc'];  ?>.
              
</div>
<div id="butlayout">
    <div id="submitdiv" >
        <input id="submit" type="submit" value="Close" />
    </div>    
</div>

<script>
  $(function() 
  {    
    
    
  }); 
  
   $("#submit").click(
      function(){         
        var win = window.open('', '_self'); window.close(); win.close();        
  });
        
  
</script>