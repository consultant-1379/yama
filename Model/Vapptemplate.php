<?php
App::uses('AppModel', 'Model');
/**
 * Vapptemplate Model
 *
 */
class Vapptemplate extends AppModel {

    
        public $displayField = 'name';
/**
 * Validation rules
 *
 * @var array
 */
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
                            SELECT `Lease`.`id`, `Lease`.`lease_type_id`, `Lease`.`expiry_date`, `Lease`.`remainders`, `Lease`.`machine_type_id`, `Lease`.`host_id`, `Lease`.`emails`, `LeaseType`.`id`, `LeaseType`.`lease_type_name`, `LeaseType`.`machine_type_id`, `LeaseType`.`lease_type_desc`, `MachineType`.`id`, `MachineType`.`machine_type_name` FROM `yama`.`leases` AS `Lease` LEFT JOIN `yama`.`lease_types` AS `LeaseType` ON (`Lease`.`lease_type_id` = `LeaseType`.`id`) LEFT JOIN `yama`.`machine_types` AS `MachineType` ON (`Lease`.`machine_type_id` = `MachineType`.`id`) WHERE `Lease`.`host_id` = {$__cakeID__$} AND `Lease`.`machine_type_id` ='.$machine_types['VAPPTEMP'],
			'counterQuery' => ''
		)
	);
            parent::__construct($id, $table, $ds);
    }
}
