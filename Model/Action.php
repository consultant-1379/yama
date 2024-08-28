<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
/**
 * Lease Model
 *
 * @property LeaseType $LeaseType
 * @property MachineType $MachineType
 * @property Pmachine $Pmachine
 */
class Action extends AppModel {


        public $actsAs = array('vCloud');
        
        public function suspend_vapps()
        {  
            $date =  date("Y-m-d", strtotime('-1 day')) ;  
            $lease_types=Configure::read('LeaseTypes');
            $leases = ClassRegistry::init('Lease')->find('all',array(
                    'conditions' => array('Lease.expiry_date' => $date,'Lease.lease_type_id' => $lease_types['VAPPRUNTIME']),
                    'recursive' => -1
                    ));	
            
            $mrHandler = new MultiRequest_Handler();
            $mrHandler->onRequestComplete(array($this, 'suspendrequestComplete'));
           
            $options = array();                        
            $options[CURLOPT_HTTPAUTH] = CURLAUTH_BASIC;
            $options[CURLOPT_USERPWD] = 'Administrator:admin01';
            $options[CURLOPT_PROXY] = '';            
            $mrHandler->requestsDefaults()->addCurlOptions($options);
            $SPP=Configure::read('SPP');
            $baseurl = Configure::read('spp.url').$SPP['STOPVAPP'];            
            //debug($leases);
            
            foreach ($leases as $lease) 
            {                
                //CakeLog::write('debug', '***'.$lease['Lease']['id']);   
                if(isset($lease['Lease']['host']['Vapp']))
                {
                    echo '<br>'.date("Y-m-d",strtotime($lease['Lease']['expiry_date']));
                    echo '<br>'.$lease['Lease']['host']['Vapp']['name']; 
                    $url = $baseurl . $lease['Lease']['host']['Vapp']['vcd_id'].'.xml';
                    echo '<br>'.$url;
                    $request = new MultiRequest_Request($url);
                    //debug($lease['Lease']);
                    $request->setInfo($lease['Lease']);
                    $mrHandler->pushRequestToQueue($request);
                }
            }
            $mrHandler->start();
        }

        public function suspendrequestComplete(MultiRequest_Request $request, MultiRequest_Handler $handler) {
            echo('Request complete: ' . $request->getUrl() . ' Code: ' . $request->getCode());
            //echo('Result'.$request->getContent());
            $lease=$request->getInfo();
            //debug($lease['host']['Vapp']);
            //echo('Request complete: ' . $lease['emails']);
            echo('Request complete: ' . $lease['host']['Vapp']['vcd_id']);
            CakeLog::write('debug', '***'.$request->getContent());

            $orgVdc = $lease['host']['Vapp']['vdc']['OrgVdc']['name'];
            if (empty($orgVdc)){
                $orgVdc = 'UNDEFINED';
            }

            $Email = new CakeEmail();
            $Email->template('vappsuspended', 'custom');
            $Email->emailFormat('html');
            $Email->viewVars(array(
                    'date' => date("Y-m-d H:i:s"),
                    'vppname' => $lease['host']['Vapp']['name'],
                    'hostname' => Configure::read('spp.hostname'),
                    'hostLink' => Configure::read('spp.url'),
                    'org_vdc' => $orgVdc,
                    ));
            $Email->from(array('no_reply@ericsson.com' => 'Cloud Life Cycle Manager'));

            $tos = array();
            $tosgiven  = explode(";",preg_replace('/\s/', '', $lease['emails']));
            foreach ($tosgiven as $to)
            {
                if (filter_var($to, FILTER_VALIDATE_EMAIL))
                    array_push($tos, $to);
            }
            if (!empty($tos)) {
                $Email->to($tos);
                $Email->subject('vApp:'.$lease['host']['Vapp']['name'].' powered off');
                $Email->send();
            }
        }

        public function destroy_vapps()
        {
            $date =  date("Y-m-d", strtotime('-1 day')) ;
            $lease_types=Configure::read('LeaseTypes');
            $leases = ClassRegistry::init('Lease')->find('all',array(
                    'conditions' => array('Lease.expiry_date' => $date,'Lease.lease_type_id' => $lease_types['VAPPSTORAGE']),
                    'recursive' => -1
                    ));

            $mrHandler = new MultiRequest_Handler();
            $mrHandler->onRequestComplete(array($this, 'destroyrequestComplete'));

            $options = array();
            $options[CURLOPT_HTTPAUTH] = CURLAUTH_BASIC;
            $options[CURLOPT_USERPWD] = 'Administrator:admin01';
            $options[CURLOPT_PROXY] = '';
            $mrHandler->requestsDefaults()->addCurlOptions($options);
            $SPP=Configure::read('SPP');
            $baseurl = Configure::read('spp.url').$SPP['VAPPDESTROY'];
            //debug($leases);

            foreach ($leases as $lease)
            {
                //CakeLog::write('debug', '***'.$lease['Lease']['id']);
                if(isset($lease['Lease']['host']['Vapp']))
                {
                    echo '<br>'.date("Y-m-d",strtotime($lease['Lease']['expiry_date']));
                    echo '<br>'.$lease['Lease']['host']['Vapp']['name'];
                    $url = $baseurl . $lease['Lease']['host']['Vapp']['vcd_id'].'.xml';
                    echo '<br>'.$url;
                    $request = new MultiRequest_Request($url);
                    //debug($lease['Lease']);
                    $request->setInfo($lease['Lease']);
                    $mrHandler->pushRequestToQueue($request);
                }
            }
            $mrHandler->start();
        }

        public function destroyrequestComplete(MultiRequest_Request $request, MultiRequest_Handler $handler) {
            echo('Request complete: ' . $request->getUrl() . ' Code: ' . $request->getCode());
            //echo('Result'.$request->getContent());
            $lease=$request->getInfo();
            //debug($lease['host']['Vapp']);
            //echo('Request complete: ' . $lease['emails']);
            echo('Request complete: ' . $lease['host']['Vapp']['vcd_id']);
            CakeLog::write('debug', '***'.$request->getContent());

            $orgVdc = $lease['host']['Vapp']['vdc']['OrgVdc']['name'];
            if (empty($orgVdc)){
                $orgVdc = 'UNDEFINED';
            }

            $Email = new CakeEmail();
            $Email->template('vappdestroyed', 'custom');
            $Email->emailFormat('html');
            $Email->viewVars(array(
                    'date' => date("Y-m-d H:i:s"),
                    'vppname' => $lease['host']['Vapp']['name'],
                    'hostname' => Configure::read('spp.hostname'),
                    'hostLink' => Configure::read('spp.url') ,
                    'org_vdc' => $orgVdc,
                    ));
            $Email->from(array('no_reply@ericsson.com' => 'Cloud Life Cycle Manager'));

            $tos = array();
            $tosgiven  = explode(";",preg_replace('/\s/', '', $lease['emails']));
            foreach ($tosgiven as $to)
            {
                if (filter_var($to, FILTER_VALIDATE_EMAIL)) 
                    array_push($tos, $to);
            }
            if (!empty($tos)) {
                $Email->to($tos);
                $Email->subject('vApp:'.$lease['host']['Vapp']['name'].' destroyed');
                $Email->send();
            }
        }

        public function destroy_vapptemplates()
        {
            $date =  date("Y-m-d", strtotime('-1 day')) ;
            $lease_types=Configure::read('LeaseTypes');
            $leases = ClassRegistry::init('Lease')->find('all',array(
                    'conditions' => array('Lease.expiry_date' => $date,'Lease.lease_type_id' => $lease_types['CATVAPPSTORAGE']),
                    'recursive' => -1
                    ));	

            $deletionHandler = new MultiRequest_Handler();

            $options = array();
            $options[CURLOPT_HTTPAUTH] = CURLAUTH_BASIC;
            $options[CURLOPT_USERPWD] = 'Administrator:admin01';
            $options[CURLOPT_PROXY] = '';
            $deletionHandler->requestsDefaults()->addCurlOptions($options);
            $SPP=Configure::read('SPP');

            $detailsHandler = new MultiRequest_Handler();
            $detailsHandler->requestsDefaults()->addCurlOptions($options);
            $detailsHandler->onRequestComplete(array($this, 'destroyvapptemprequestComplete'));

            $baseurl = Configure::read('spp.url');

            foreach ($leases as $lease)
            {
                if(isset($lease['Lease']['host']['Vapptemplate']) && $this->vcIsExists($lease['Lease']['host']['Vapptemplate']))
                {
                    echo '<br>'.date("Y-m-d",strtotime($lease['Lease']['expiry_date']));
                    echo '<br>'.$lease['Lease']['host']['Vapptemplate']['name'];
                    $detailsUrl = $baseurl . $SPP['CATVAPPDETAILS'] . $lease['Lease']['host']['Vapptemplate']['templateid'].'.xml';
                    $deletionUrl = $baseurl . $SPP['CATVAPPDELETE'] . $lease['Lease']['host']['Vapptemplate']['templateid'].'.xml';
                    echo '<br>'.$detailsUrl;
                    $detailsRequest = new MultiRequest_Request($detailsUrl);
                    $detailsRequest->setInfo($lease['Lease']);
                    $detailsHandler->pushRequestToQueue($detailsRequest);

                    echo '<br>'.$deletionUrl;
                    $deletionRequest = new MultiRequest_Request($deletionUrl);
                    $deletionHandler->pushRequestToQueue($deletionRequest);
                }
            }
            $detailsHandler->start();
            $deletionHandler->start();
        }

        public function destroyvapptemprequestComplete(MultiRequest_Request $request, MultiRequest_Handler $handler) {
            echo('Request complete: ' . $request->getUrl() . ' Code: ' . $request->getCode());
            $lease=$request->getInfo();

            echo('Request complete: ' . $lease['host']['Vapptemplate']['templateid']);
            CakeLog::write('debug', '***'.$request->getContent());
            $xmlString = $request->getContent();
            $xmlArray = Xml::toArray(Xml::build($xmlString));

            $Email = new CakeEmail();
            $Email->template('vapptemplatedestroyed', 'custom');
            $Email->emailFormat('html');
            $Email->viewVars(array(
                    'date' => date("Y-m-d H:i:s"),
                    'vppname' => $lease['host']['Vapptemplate']['name'],
                    'url' => Configure::read('yama.url').'/renew/view/'.$lease['id'],
                    'hostname' => Configure::read('spp.hostname'),
                    'hostLink' => Configure::read('spp.url'),
                    'org_vdc' => $xmlArray['response']['catalog_details']['catalog_name'],
                    ));
            $Email->from(array('no_reply@ericsson.com' => 'Cloud Life Cycle Manager'));

            $tos = array();
            $tosgiven  = explode(";",preg_replace('/\s/', '', $lease['emails']));
            foreach ($tosgiven as $to)
            {
                if (filter_var($to, FILTER_VALIDATE_EMAIL))
                    array_push($tos, $to);
            }
            if (!empty($tos)) {
                $Email->to($tos);
                $Email->subject('Catalogued vApp:'.$lease['host']['Vapptemplate']['name'].' destroyed');
                $Email->send();
            }
        }
}
