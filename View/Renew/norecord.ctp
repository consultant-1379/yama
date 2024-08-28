<?php 
$this->layout='renew';
?>
<div class="renew">
    <h2><?php  echo __('Lease does not exist'); ?></h2>           
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