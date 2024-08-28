<?php
App::uses('AppModel', 'Model');
/**
 * MachineType Model
 *
 * @property LeaseType $LeaseType
 * @property Lease $Lease
 */
class MachineType extends AppModel {

    
    public $displayField = 'machine_type_name';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'machine_type_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'LeaseType' => array(
			'className' => 'LeaseType',
			'foreignKey' => 'machine_type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
//		),
//		'Lease' => array(
//			'className' => 'Lease',
//			'foreignKey' => 'machine_type_id',
//			'dependent' => false,
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'exclusive' => '',
//			'finderQuery' => '',
//			'counterQuery' => ''
		)
	);

}
