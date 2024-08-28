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
class Notify extends AppModel {


        //public $uses = array('Lease');
        public $actsAs = array('vCloud');

	public function notify_runtimelease_expiry()
        {
            $lengths = Configure::read('LeaseLengths');
            $start_date =  date("Y-m-d", strtotime('now')) ;
            $end_date =  date("Y-m-d", strtotime('+' . $lengths['NotificationPeriod'] . ' day')) ;
//            echo $start_date;
//            echo '<br>'.$end_date;
            $lease_types=Configure::read('LeaseTypes');
            $leases = ClassRegistry::init('Lease')->find('all',array(
                    'conditions' => array('Lease.expiry_date between ? and ?' => array($start_date, $end_date),'Lease.lease_type_id' => $lease_types['VAPPRUNTIME'] , 'Lease.remainders' => '1'),
                    'recursive' => -1
                    ));

            //debug($leases);

            foreach ($leases as $lease)
            {
                //CakeLog::write('debug', '***'.$lease['Lease']['id']);
                if(isset($lease['Lease']['host']['Vapp']))
                {
                    echo '<br>'.date("Y-m-d",strtotime($lease['Lease']['expiry_date']));
                    echo '<br>'.$lease['Lease']['host']['Vapp']['name'];

                    $orgVdc = $lease['Lease']['host']['Vapp']['vdc']['OrgVdc']['name'];
                    if (empty($orgVdc)){
                        $orgVdc = 'UNDEFINED';
                    }

                    $Email = new CakeEmail();
                    $Email->template('runtimeleaseexpiry', 'custom');
                    $Email->emailFormat('html');
                    $Email->viewVars(array(
                        'date' => date("Y-m-d",strtotime($lease['Lease']['expiry_date'])),
                        'vppname' => $lease['Lease']['host']['Vapp']['name'],
                        'url' => Configure::read('yama.url').'/renew/view/'.$lease['Lease']['id'],
                        'hostname' => Configure::read('spp.hostname'),
                        'hostLink' => Configure::read('spp.url'),
                        'org_vdc' => $orgVdc,
                        ));
                    $Email->from(array('no_reply@ericsson.com' => 'Cloud Life Cycle Manager'));

                    $tos = array();
                    $tosgiven  = explode(";",preg_replace('/\s/', '', $lease['Lease']['emails']));
                    foreach ($tosgiven as $to)
                    {
                        if (filter_var($to, FILTER_VALIDATE_EMAIL))
                            array_push($tos, $to);
                    }
                    if (!empty($tos)) {
                        $Email->to($tos);
                        $Email->subject('vApp:'.$lease['Lease']['host']['Vapp']['name'].' will be powered off');
                        $Email->send();
                    }
                }
                else
                {
                    ClassRegistry::init('Lease')->save(
                            array(
                                "Lease" => array(
                                        "id" => $lease['Lease']['id'],
                                        "remainders" => "0",
                                )
                        ));
                }
            }
            
        }
        
         public function notify_storagelease_expiry()
        {
            $lengths = Configure::read('LeaseLengths');
            $start_date =  date("Y-m-d", strtotime('now')) ;
            $end_date =  date("Y-m-d", strtotime('+' . $lengths['NotificationPeriod'] . ' day')) ;
//            echo $start_date;
//            echo '<br>'.$end_date;
            $lease_types=Configure::read('LeaseTypes');
            $leases = ClassRegistry::init('Lease')->find('all',array(
                    'conditions' => array('Lease.expiry_date between ? and ?' => array($start_date, $end_date),'Lease.lease_type_id' => $lease_types['VAPPSTORAGE'], 'Lease.remainders' => '1'),
                    'recursive' => -1
                    ));

            //debug($leases);

            foreach ($leases as $lease)
            {
                //CakeLog::write('debug', '***'.$lease['Lease']['id']);
                if(isset($lease['Lease']['host']['Vapp']))
                {
                    echo '<br>'.date("Y-m-d",strtotime($lease['Lease']['expiry_date']));
                    echo '<br>'.$lease['Lease']['host']['Vapp']['name'];

                    $orgVdc = $lease['Lease']['host']['Vapp']['vdc']['OrgVdc']['name'];
                    if (empty($orgVdc)){
                        $orgVdc = 'UNDEFINED';
                    }

                    $Email = new CakeEmail();
                    $Email->template('storageleaseexpiry', 'custom');
                    $Email->emailFormat('html');
                    $Email->viewVars(array(
                        'date' => date("Y-m-d",strtotime($lease['Lease']['expiry_date'])),
                        'vppname' => $lease['Lease']['host']['Vapp']['name'],
                        'url' => Configure::read('yama.url').'/renew/view/'.$lease['Lease']['id'],
                        'hostname' => Configure::read('spp.hostname'),
                        'hostLink' => Configure::read('spp.url'),
                        'org_vdc' => $orgVdc,
                        ));
                    $Email->from(array('no_reply@ericsson.com' => 'Cloud Life Cycle Manager'));
                    $tos = array();
                    $tosgiven  = explode(";",preg_replace('/\s/', '', $lease['Lease']['emails']));
                    foreach ($tosgiven as $to)
                    {
                        if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
                            array_push($tos, $to);
                        }
                    }
                    if (!empty($tos)) {
                        $Email->to($tos);
                        $Email->subject('vApp:'.$lease['Lease']['host']['Vapp']['name'].' will be destroyed');
                        $Email->send();
                    }
                }
                else
                {
                    ClassRegistry::init('Lease')->save(
                            array(
                                "Lease" => array(
                                        "id" => $lease['Lease']['id'],
                                        "remainders" => "0",
                                )
                        ));
                }

            }

        }

        public function notify_vapptemp_storagelease_expiry()
        {
            $lengths = Configure::read('LeaseLengths');
            $start_date =  date("Y-m-d", strtotime('now')) ;
            $end_date =  date("Y-m-d", strtotime('+' . $lengths['NotificationPeriod'] . ' day')) ;
//            echo $start_date;
//            echo '<br>'.$end_date;
            $lease_types=Configure::read('LeaseTypes');
            $leases = ClassRegistry::init('Lease')->find('all',array(
                    'conditions' => array('Lease.expiry_date between ? and ?' => array($start_date, $end_date),'Lease.lease_type_id' => $lease_types['CATVAPPSTORAGE'], 'Lease.remainders' => '1'),
                    'recursive' => -1
                    ));


            $mrHandler = new MultiRequest_Handler();
            $mrHandler->onRequestComplete(array($this, 'notify_vapptemp_storagelease_expiry_complete'));

            $options = array();
            $options[CURLOPT_HTTPAUTH] = CURLAUTH_BASIC;
            $options[CURLOPT_USERPWD] = 'Administrator:admin01';
            $options[CURLOPT_PROXY] = '';
            $mrHandler->requestsDefaults()->addCurlOptions($options);
            $SPP=Configure::read('SPP');
            $baseurl = Configure::read('spp.url').$SPP['CATVAPPDETAILS'];
            
            foreach ($leases as $lease) 
            {
                CakeLog::write('debug', 'Calling Behavior');
                if(isset($lease['Lease']['host']['Vapptemplate']) && $this->vcIsExists($lease['Lease']['host']['Vapptemplate']))
                {
                    echo '<br>'.date("Y-m-d",strtotime($lease['Lease']['expiry_date']));
                    echo '<br>'.$lease['Lease']['host']['Vapptemplate']['name'];

                    $template_id = $lease['Lease']['host']['Vapptemplate']['templateid'];
                    $url = $baseurl . $template_id.'.xml';
                    echo '<br>'.$url;
                    $request = new MultiRequest_Request($url);
                    $request->setInfo($lease['Lease']);
                    $mrHandler->pushRequestToQueue($request);
                }
                else
                {
                    ClassRegistry::init('Lease')->save(
                            array(
                                "Lease" => array(
                                        "id" => $lease['Lease']['id'],
                                        "remainders" => "0",
                                )
                        ));
                }
            }
            $mrHandler->start();
        }

        public function notify_vapptemp_storagelease_expiry_complete(MultiRequest_Request $request, MultiRequest_Handler $handler)
        {
            CakeLog::write('debug', '***'.$request->getContent());
            $xmlString = $request->getContent();
            $xmlArray = Xml::toArray(Xml::build($xmlString));

            $lease=$request->getInfo();
            $Email = new CakeEmail();
            $Email->template('vapptempstorageleaseexpiry', 'custom');
            $Email->emailFormat('html');
            $Email->viewVars(array(
                'date' => date("Y-m-d",strtotime($lease['expiry_date'])),
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
                $Email->subject('Catalogued vApp:'.$lease['host']['Vapptemplate']['name'].' will be destroyed');
                $Email->send();
            }

        }
}
        
