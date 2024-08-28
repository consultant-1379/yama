<?php 
$this->layout='renew';
?>
<div class="renew">
    <h2><?php  echo __('Lease Renewed'); ?></h2>
    <?php echo $lease['LeaseType']['lease_type_name'];  ?> Lease for the Machine: 
    <span style="color:brown">    
    <?php echo $host;  ?>
    </span>	
      is now renewed and set to expire on <span style="color:brown"><?php echo $lease['Lease']['expiry_date'] ?></span>.
      Reminder mails will be sent to the email: <span style="color:brown"><?php echo $lease['Lease']['emails'] ?></span> ,five days before lease expires.
      When the lease expires,<?php echo $lease['LeaseType']['lease_type_desc'];  ?>.
    <?php if(isset($stor)): ?>
      <p>Storage Lease is also extended till <span style="color:brown"><?php echo $stor ?></span>.
    <?php endif ?>  
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