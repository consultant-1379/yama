<?php
App::uses('AppModel', 'Model');
/**
 * LeaseType Model
 *
 * @property MachineType $MachineType
 * @property Lease $Lease
 */
class LeaseType extends AppModel {


    public $displayField = 'lease_type_name';
 /**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'lease_type_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'machine_type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'MachineType' => array(
			'className' => 'MachineType',
			'foreignKey' => 'machine_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

///**
// * hasMany associations
// *
// * @var array
// */
//	public $hasMany = array(
//		'Lease' => array(
//			'className' => 'Lease',
//			'foreignKey' => 'lease_type_id',
//			'dependent' => false,
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'exclusive' => '',
//			'finderQuery' => '',
//			'counterQuery' => ''
//		)
//	);

}
