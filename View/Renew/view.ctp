
<?php 
$this->layout='renew';
echo $this->Html->script('Tooltip/tooltip');
?>
<div class="renew">

<h2><?php  echo __('Renew Lease'); ?></h2>
	<dl class="renewtable">
                <dt><?php echo __('Machine Type'); ?></dt>
		<dd>
			<?php echo $lease['MachineType']['machine_type_name']; ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Lease Type'); ?></dt>
		<dd>
			<?php echo $lease['LeaseType']['lease_type_name']; ?>
			&nbsp;
		</dd>
                <?php 
                    $machine_types=Configure::read('MachineTypes');
                    if($lease['MachineType']['id'] == $machine_types['VAPP']): ?>
                
                    <dt><?php echo __('Host'); ?></dt>
                    <dd>
                        <?php 
                        if(isset($lease['Lease']['host']['Vapp']))
                            echo $lease['Lease']['host']['Vapp']['name']; 
                        else
                            echo $this->Html->div('missinghost', 'Vapp does not exist');
                        ?>                        
                            &nbsp;
                    </dd>

                    <dt><?php echo __('Vts Name'); ?></dt>
                    <dd>			
                        <?php 
                        if(isset($lease['Lease']['host']['Vapp']))
                            echo $lease['Lease']['host']['Vapp']['vts_name'];  
                        else
                            echo $this->Html->div('missinghost', 'Vapp does not exist');
                          ?>
                            &nbsp;
                    </dd>
                                
                <?php elseif($lease['MachineType']['id'] == $machine_types['PHYSICAL']): ?>
                
                    <dt><?php echo __('Host'); ?></dt>
                    <dd>			
                        <?php 
                        if(isset($lease['Lease']['host']['Pmachine']))
                            echo $lease['Lease']['host']['Pmachine']['hostname'];
                        else
                            echo $this->Html->div('missinghost', 'Pmachine does not exist');
                        ?>
                            &nbsp;
                    </dd>
                    
                    <dt><?php echo __('Vts Name'); ?></dt>
                    <dd>			
                        <?php 
                          if(isset($lease['Lease']['host']['Pmachine']))
                            echo $lease['Lease']['host']['Pmachine']['hostname'];  
                          else
                            echo $this->Html->div('missinghost', 'Pmachine does not exist');  
                         ?>
                            &nbsp;
                    </dd>
                 <?php elseif($lease['MachineType']['id'] == $machine_types['VAPPTEMP']): ?>
                
                    <dt><?php echo __('Host'); ?></dt>
                    <dd>			
                        <?php 
                        if(isset($lease['Lease']['host']['Vapptemplate']))
                            echo $lease['Lease']['host']['Vapptemplate']['name'];
                        else
                            echo $this->Html->div('missinghost', 'Vapptemplate does not exist');
                        ?>
                            &nbsp;
                    </dd>
                    
                    <dt><?php echo __('Vts Name'); ?></dt>
                    <dd>			
                        <?php 
                          if(isset($lease['Lease']['host']['Vapptemplate']))
                            echo $lease['Lease']['host']['Vapptemplate']['name'];  
                          else
                            echo $this->Html->div('missinghost', 'Vapptemplate does not exist');  
                         ?>
                            &nbsp;
                    </dd>   
                
                <?php endif ?>		
                <?php if( isset($otherleases) && sizeof($otherleases) != 0): ?>
                    <dt><?php echo __('Other Leases'); ?></dt>
                    <dd>
                        <?php  foreach ($otherleases as $leas): ?>  
                            <?php if(!($leas['id'] == $lease['Lease']['id'])):?>                            
                                <?php echo $this->Html->link($leas['LeaseType']['lease_type_name'], array('controller' => 'renew', 'action' => 'view', $leas['id'])); ?>
                                &nbsp;
                                <br>  
                            <?php endif ?>
                        <?php endforeach; ?>
                    </dd>                    
                    
                <?php endif ?>	    
                <dt><?php echo __('Emails'); ?></dt>
		<dd>			
                        <input type="text" id="email" class ="tooltip" title="Multiple emails should be seperated using ;"/>                                        
		</dd>               
                
                <dt><?php echo __('Expiry Date'); ?></dt>
		<dd>
                    <input type="text" id="datepicker" readonly/>                                        
		</dd>
		
	</dl>                
</div>
<div id="butlayout">
    <div id="submitdiv" >
        <input id="submit" class="button-disabled"  type="submit" value="Renew Lease" />
    </div>
    <div id="letitgodiv" >
        <input id="letitgo" class="button-enabled" type="submit" value="Let it expire!" />
    </div>
</div>
<input type="hidden" id="refreshed" value="no">

<center><h4>**Please click the date and choose a new expiry date to renew the lease</h4></center>

<script>
  $(function() 
  {   
    var emails=<?php echo json_encode($lease['Lease']['emails'])?>;       
    var dat=<?php echo json_encode($lease['Lease']['expiry_date'])?>;       
    var midat=<?php echo json_encode($minDat)?>;   
    var mxdat=<?php echo json_encode($maxDat)?>;  
    $("#email").val(emails);
    //alert('S'+dat+'E');
    //alert('S'+midat+'E');
    //alert(mxdat);
    var remainder=<?php echo json_encode($lease['Lease']['remainders'])?>;
    //alert(remainder);
    var e=document.getElementById("refreshed");
    if(e.value=="no")e.value="yes";
    else{e.value="no";location.reload();}
    //location.reload();
    $("#submit").attr('disabled', 'disabled' ).css('color','#bbb');
    if(!remainder)
        $("#letitgo").attr('disabled', 'disabled' ).css('color','#bbb');
    var expiryDate = new Date(dat);
    var maxDat = new Date(mxdat); //Todays Date
    var minDat = new Date(midat);
    $("#datepicker").datepicker({ minDate: minDat, maxDate: maxDat,dateFormat: 'yy-mm-dd'});
    $("#datepicker").datepicker("setDate",expiryDate);
    $("#datepicker").change(
            function(){
                $("#submit").removeAttr('disabled').css('color','#333');
                $("#letitgo").attr('disabled', 'disabled' ).css('color','#bbb');
            }
        );

    $("#submit").click(
        function(){
            var newdate=$("#datepicker").val();
            var newdat = new Date(newdate);
            var diffDays = parseInt((newdat - expiryDate) / (1000 * 60 * 60 * 24));
            var stoexpiryDat = null;
            <?php if( isset($otherleases) && sizeof($otherleases) != 0): ?>
            <?php  foreach ($otherleases as $leas): ?>  
                  <?php if(!($leas['id'] == $lease['Lease']['id']) && $leas['LeaseType']['id'] == 1):?>
                       var stoexpiryDat = new Date(<?php echo json_encode($leas['expiry_date'])?>);
                       stoexpiryDat.setDate(stoexpiryDat.getDate() + diffDays);
                       //alert(stoexpiryDat);
                       //alert($.datepicker.formatDate('yy-mm-dd', stoexpiryDat));
                       var leasedata = {
                                "Lease" : {
                                        "id" : "<?php echo $leas['id']; ?>",
                                        "machine_type_id" : "<?php echo $leas['machine_type_id']; ?>",
                                        "lease_type_id" : "<?php echo $leas['lease_type_id']; ?>",                                                                                                                
                                        "host_id" : "<?php echo $leas['host_id']; ?>",
                                        "emails" : "<?php echo $leas['emails']; ?>",		
                                        "remainders" : 1,
                                        "expiry_date" : $.datepicker.formatDate('yy-mm-dd', stoexpiryDat)
                                }
                            };
            
                        var postRequest=$.ajax(
                            {
                                type: "POST",
                                url: '/renew/renewlease.json',
                                data: JSON.stringify(leasedata),
                                contentType: "application/json",
                                dataType: "json"
                            });
                        postRequest.done(function(data, textStatus, jqXHR) {
                            //alert(jqXHR.responseText);
                            //alert("Lease Updated");

                        });

                        postRequest.fail(function(jqXHR, textStatus, errorThrown) {
                            //var responseJSON = eval('(' + jqXHR.responseText + ')');
                           // alert(responseJSON.name);                    
                        });
                      
                      <?php endif ?>
                <?php endforeach; ?>       
            <?php endif ?>            
            //Form is used instead of REST as the page needs to be redirected after form submission.            
            var form=['<?php echo $this->Form->create(null,array('url' => array('controller' => 'renew','action' => 'renewlease')));?>'];
            form.push('<?php echo $this->Form->hidden('id', array('value' => $lease['Lease']['id']));?>');
            form.push('<?php echo $this->Form->hidden('machine_type_id', array('value' => $lease['Lease']['machine_type_id']));?>');
            form.push('<?php echo $this->Form->hidden('lease_type_id', array('value' => $lease['Lease']['lease_type_id']));?>');
            form.push('<?php echo $this->Form->hidden('host_id', array('value' => $lease['Lease']['host_id']));?>');            
            form.push('<input type="hidden" name="data[Lease][emails]" value="'+$("#email").val()+'" id="LeaseEmails"/>');            
            form.push('<?php echo $this->Form->hidden('remainders', array('value' => "1"));?>');            
            form.push('<input type="hidden" name="data[Lease][expiry_date]" value="'+newdate+'" id="LeaseExpiryDate"/>');
            if(stoexpiryDat != null)    
               form.push('<input type="hidden" name="data[storage_expiry_date]" value="'+$.datepicker.formatDate('yy-mm-dd', stoexpiryDat)+'" id="StoLeaseExpiryDate"/>');
            form.push('<?php echo $this->Form->end();?>');
            jQuery(form.join('')).appendTo('body')[0].submit();                               

        });
        
       $("#letitgo").click(
        function(){ 
            //alert($("#remainder").is(':checked'));
            var form=['<?php echo $this->Form->create(null,array('url' => array('controller' => 'renew','action' => 'letitexpire')));?>'];
            form.push('<?php echo $this->Form->hidden('id', array('value' => $lease['Lease']['id']));?>');
            form.push('<?php echo $this->Form->hidden('machine_type_id', array('value' => $lease['Lease']['machine_type_id']));?>');
            form.push('<?php echo $this->Form->hidden('lease_type_id', array('value' => $lease['Lease']['lease_type_id']));?>');
            form.push('<?php echo $this->Form->hidden('host_id', array('value' => $lease['Lease']['host_id']));?>');
            form.push('<input type="hidden" name="data[Lease][emails]" value="'+$("#email").val()+'" id="LeaseEmails"/>');            
            form.push('<?php echo $this->Form->hidden('remainders', array('value' => "0"));?>');            
            form.push('<input type="hidden" name="data[Lease][expiry_date]" value="'+$("#datepicker").val()+'" id="LeaseExpiryDate"/>');
            form.push('<?php echo $this->Form->end();?>');
            jQuery(form.join('')).appendTo('body')[0].submit();               
        });
    
  }); 
  
</script>
