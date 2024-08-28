<?php
App::uses('AppModel', 'Model');
/**
 * Pmachine Model
 *
 * @property Lease $Lease
 */
class Pmachine extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'hostname';        
   
        
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	
        
        public function __construct($id = false, $table = null, $ds = null) {
            $machine_types=Configure::read('MachineTypes');
            $this->hasMany = array(
		'Lease' => array(
			'className' => 'Lease',
			'foreignKey' => 'host_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '
                            SELECT `Lease`.`id`, `Lease`.`lease_type_id`, `Lease`.`expiry_date`, `Lease`.`remainders`, `Lease`.`machine_type_id`, `Lease`.`host_id`, `Lease`.`emails`, `LeaseType`.`id`, `LeaseType`.`lease_type_name`, `LeaseType`.`machine_type_id`, `LeaseType`.`lease_type_desc`, `MachineType`.`id`, `MachineType`.`machine_type_name` FROM `yama`.`leases` AS `Lease` LEFT JOIN `yama`.`lease_types` AS `LeaseType` ON (`Lease`.`lease_type_id` = `LeaseType`.`id`) LEFT JOIN `yama`.`machine_types` AS `MachineType` ON (`Lease`.`machine_type_id` = `MachineType`.`id`) WHERE `Lease`.`host_id` = {$__cakeID__$} AND `Lease`.`machine_type_id` ='.$machine_types['PHYSICAL'],
			'counterQuery' => ''
		)
	);
            parent::__construct($id, $table, $ds);
    }

}
