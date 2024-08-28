<?php
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout . " - Yama"; ?>
        </title>
        <?php
        //jquiry libraries and css library for jquery ui
        echo $this->Html->css('staticfiles/jquery-ui-1.10.4.custom.min');
        echo $this->Html->script('staticfiles/jquery-1.10.2.min');
        echo $this->Html->script('staticfiles/jquery-ui-1.10.4.custom.min');
        echo $this->Html->meta('icon');
        // CSS

        echo $this->Html->css('login');
        echo $this->fetch('css');
        echo $this->fetch('meta');
        // Javascript        	
        echo $this->fetch('script');
        //echo $this->Js->writeBuffer(array('cache' => TRUE));
        ?>
    </head>
    <body>        
        <div id="Main borderline" >
            <div class="header borderline">	
                <img class="logo" src="/img/elogo.png" alt="Ericsson"></img>                    
            </div>
        </div>
        <div id="Content">
            <div id="leftContent">                
                <div class="prodHead">
                    <h1>YAMA</h1>
                    <h2>A Lifecycle Management Tool</h2>
                </div>                
                <p>Lifecylemanagement tool manages the lifecycle of TE Resources and helps in optimum utilisation and management of the Resources.It provides the following</p>                                            
                <ul class="features">
                    <li>
                        <img src="/img/lease.png"></img>
                        <p class="title">Leases</p>
                        <p>Every TE resource is associated with an expiry date in terms of leases</p>
                    </li>
                    <li>
                        <img src="/img/email.png"></img>
                        <p class="title">Reminder Mails</p>
                        <p>Whenever Lease is about to expire,reminder mails with appropriate info are sent to the owner of the TE Resource</p>
                    </li>
                    <li>
                        <img src="/img/actions.png"></img>
                        <p class="title">Actions</p>
                        <p>Whenever Lease expires,actions specific to lease is taken against the TE Resource</p>
                    </li>
                </ul>
            </div>   
            <div id="rightContent">                                                    
                <div id="login" class="loginBox  ui-corner-all">
                    <?php echo $content_for_layout ?>                       
                </div>
            </div>
        </div>        
    </body>
</html>
