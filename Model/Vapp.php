<?php
App::uses('AppModel', 'Model');
/**
 * Vapp Model
 *
 * @property Leases $leases
 */
class Vapp extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
        var $useDbConfig = 'vappDB';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array */

        public $belongsTo = array(
        'OrgVdc' => array(
            'className' => 'OrgVdc',
            'foreignKey' => 'org_vdc_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

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
                            SELECT `Lease`.`id`, `Lease`.`lease_type_id`, `Lease`.`expiry_date`, `Lease`.`remainders`, `Lease`.`machine_type_id`, `Lease`.`host_id`, `Lease`.`emails`, `LeaseType`.`id`, `LeaseType`.`lease_type_name`, `LeaseType`.`machine_type_id`, `LeaseType`.`lease_type_desc`, `MachineType`.`id`, `MachineType`.`machine_type_name` FROM `yama`.`leases` AS `Lease` LEFT JOIN `yama`.`lease_types` AS `LeaseType` ON (`Lease`.`lease_type_id` = `LeaseType`.`id`) LEFT JOIN `yama`.`machine_types` AS `MachineType` ON (`Lease`.`machine_type_id` = `MachineType`.`id`) WHERE `Lease`.`host_id` = {$__cakeID__$} AND `Lease`.`machine_type_id` ='.$machine_types['VAPP'],
			'counterQuery' => ''
		)
	);
            parent::__construct($id, $table, $ds);
    }

    public function afterFind($results,$primary = false)
       {
             foreach ($results as $key => $val)
             {
                 if (isset($val['Vapp']['org_vdc_id'])) {
                    $vcds = ClassRegistry::init('OrgVdc')->find('first', array(
                                'conditions' => array('OrgVdc.vcd_id' => $val['Vapp']['org_vdc_id']),
                                'recursive' => -1
                        ));
                    $results[$key]['Vapp']['vdc']=$vcds;
                 }
             }
            return $results;

    }
}
