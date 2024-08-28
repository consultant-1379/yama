<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Lifecycle Management Tool');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
                $msie        = strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE') ? true : false; 
                $firefox    = strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') ? true : false;
                $safari        = strpos($_SERVER["HTTP_USER_AGENT"], 'Safari') ? true : false;
                $chrome        = strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') ? true : false;
                
                if($chrome){
                    echo $this->Html->css('yama-chrome');
                }
                else 
                    echo $this->Html->css('yama');
                
                //jquiry libraries and css
                echo $this->Html->css('staticfiles/jquery-ui-1.10.4.custom.min');
                echo $this->Html->script('staticfiles/jquery-1.10.2.min');
                echo $this->Html->script('staticfiles/jquery-ui-1.10.4.custom.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>          
</head>
<body>	
   <div id="Main borderline">
       <div class="header borderline">	
           <img class="logo" src="/img/elogo.png" alt="Ericsson"></img>              
           <h1 class="head">Lifecycle Management Tool</h1>           
      </div>
   </div>
		<div id="content" class="rcontent">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>		
	<!-- scripts_for_layout -->
	<?php echo $scripts_for_layout; ?>
	<!-- Js writeBuffer -->
	<?php
	if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer();
	// Writes cached scripts
	?>
</body>
</html>
