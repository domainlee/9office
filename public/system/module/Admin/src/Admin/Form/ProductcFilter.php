<?php
namespace Admin\Form;

use Base\InputFilter\ProvidesEventsInputFilter;

class ProductcFilter extends ProvidesEventsInputFilter{
	
	public function __construct()
	{
		$this->add(array(
				'name'   => 'name',
				'filters'   => array(
                    array('name' => 'StringTrim'),
                    array('name' => '\Base\Filter\HTMLPurifier')
				),
				'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                    'isEmpty' => 'Bạn chưa nhập loại sản phẩm'
                            ),
                        )
                    )
				),
		));

		$this->getEventManager()->trigger('init', $this);
		}

        public function setExcludedId($id) {
                $this->remove ( 'name' );
                $this->add ( array (
                        'name' => 'name',
                        'filters' => array (
                                array (
                                        'name' => 'StringTrim'
                                ),
                                array (
                                        'name' => 'StringToLower'
                                ),
                                array (
                                        'name' => '\Base\Filter\HTMLPurifier'
                                )
                        ),
                        'validators' => array (
                                array (
                                        'name' => 'NotEmpty',
                                        'break_chain_on_failure' => true,
                                        'options' => array (
                                                'messages' => array (
                                                        'isEmpty' => 'Bạn chưa nhập loại sản phẩm'
                                                )
                                        )
                                ),
        // 						array (
        // 								'name' => 'Db\NoRecordExists',
        // 								'options' => array (
        // 										'table' => 'product_categories',
        // 										'field' => 'name',
        // 										'exclude' => array (
        // 												'field' => 'id',
        // 												'value' => $id
        // 										),
        // 										'adapter' => \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::getStaticAdapter (),
        // 										'messages' => array (
        // 												'recordFound' => "Tên loại sản phẩm này đã được sử dụng"
        // 										)
        // 								)
        // 						)
                        )
                ) );
                }
        }
