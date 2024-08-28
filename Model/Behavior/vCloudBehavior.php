<?php

class vCloudBehavior extends ModelBehavior {

    public function vcIsExists(Model $model, $vAppTemplate) {                
        //do something
        //CakeLog::write('debug', 'Calling Cloud Behavior');
        CakeLog::write('debug', 'Calling Cloud Behavior'.'myArray'.print_r($vAppTemplate, true));
        CakeLog::write('debug', 'vapptemplate name'.$vAppTemplate['name']);
        
        //Call Rest Service
        $ch = curl_init();        
        $SPP=Configure::read('SPP');
        $spp_hostname = strtok(shell_exec('hostname -f'), "\n");
        $url = 'http://'.$spp_hostname.$SPP['CATVAPPISEXISTS'].$vAppTemplate['templateid'].'.xml'; 
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
        curl_setopt( $ch, CURLOPT_USERPWD, 'Administrator:admin01' );
        curl_setopt( $ch, CURLOPT_PROXY, '');
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec( $ch );
        $response = curl_getinfo( $ch );
        curl_close ( $ch );
        CakeLog::write('debug', 'http code'.$response['http_code'].'content'.$content);
        //if true return true else delete u'r local and return false
        if ($response['http_code'] == 200)             
            return true;
        else if ($response['http_code'] == 500)             
        {
            ClassRegistry::init('Vapptemplate')->delete($vAppTemplate['id']);
            return false;
        }
        else
        {
            CakeLog::write('error', 'Problem in checking the vapptemplate exist'.$response['http_code'].'content'.$content);
            return false;
        }
    }
}
?>
