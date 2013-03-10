<?php
namespace Course\Form;

use Zend\Form\Form;

class CourseForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('course');
        $this->setAttribute('method', 'post');

	$this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Name',
            ),
        ));

        $this->add(array(
            'name' => 'teacher',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Teacher',
            ),
        ));

        $this->add(array(
            	'name' => 'submit',
		'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}

