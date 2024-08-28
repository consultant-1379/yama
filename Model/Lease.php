<?php
App::uses('AppModel', 'Model');
/**
 * Lease Model
 *
 * @property LeaseType $LeaseType
 * @property MachineType $MachineType
 * @property Pmachine $Pmachine
 */
class Lease extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';        
       

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
        
	public $belongsTo = array(
		'LeaseType' => array(
			'className' => 'LeaseType',
			'foreignKey' => 'lease_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),                
		'MachineType' => array(
			'className' => 'MachineType',
			'foreignKey' => 'machine_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)		
	);
        
        
      public function afterFind($results,$primary = false) 
       { 
             //$groups = ClassRegistry::init('Group')->find('all');
             //debug($results);
             foreach ($results as $key => $val) 
             {
//                 $permissions = '';
//                 foreach ($groups as $group) {                
//                      $permissions[$group['Group']['directory']] = true;                    
//                  }  
//                 $results[$key]['User']['permissions'] = $permissions;  
                  //CakeLog::write('debug', '***');
                 if (isset($val['Lease']['host_id'])) {
                     
                    //$hosts = ClassRegistry::init('Group')->find('all');
                    //CakeLog::write('debug', '***'.$val['Lease']['machine_type_id']); 
                    //CakeLog::write('debug', '***'.$results[$key]['Lease']['host_id']);
                    $machine_types=Configure::read('MachineTypes');
                    if($val['Lease']['machine_type_id'] == $machine_types['VAPP'])
                    {
                        $hosts = ClassRegistry::init('Vapp')->find('first', array(
                                'conditions' => array('Vapp.id' => $val['Lease']['host_id']),
                                'recursive' => -1
                        ));                                                
                    }
                    else if($val['Lease']['machine_type_id'] == $machine_types['PHYSICAL'])
                    {                        
                        $hosts = ClassRegistry::init('Pmachine')->find('first', array(
                                'conditions' => array('Pmachine.id' => $val['Lease']['host_id']),
                                'recursive' => -1
                        ));
                    }
                    else if($val['Lease']['machine_type_id'] == $machine_types['VAPPTEMP'])
                    {                        
                        $hosts = ClassRegistry::init('Vapptemplate')->find('first', array(
                                'conditions' => array('Vapptemplate.id' => $val['Lease']['host_id']),
                                'recursive' => -1
                        ));
                    }
                    $results[$key]['Lease']['host']=$hosts;
                    //debug($results[$key]['Lease']['host']);
//                    if (isset($results[$key]['Lease']['host']['Vapp'])) {
//                        //CakeLog::write('debug', '***'.$results[$key]['Lease']['host']['Vapp']['name']);
//                    }
                 }
             }
            return $results; 
       }
}
