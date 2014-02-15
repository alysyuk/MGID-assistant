<?php
namespace Admin\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class User implements InputFilterAwareInterface
{

    public $id;
    public $email;
    public $enabled;
    public $password;
    public $last_login;
    public $role;
    public $firstname;
    public $lastname;
    public $created_at;
    
    /**
     * @var inputFilter
     */    
    protected $inputFilter;    
    
    /**
     * Set current fields with data
     * 
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $userProperties = array_keys(get_class_vars(__CLASS__));

        foreach ($userProperties as $userProperty) {
            $this->{$userProperty} = isset($data[$userProperty])
                ? $data[$userProperty]
                : null;
        }
        
        // setting password
        if (!empty($data['password'])) {
            $this->password = sha1($data['password']);
        }

        // setting date
        if (empty($data['created_at'])) {
            $this->created_at = time();            
        }        
        
    }
   
    /**
     * {@inheritdoc}
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new Exception('Not used');
    }

    /**
     * {@inheritdoc}
     */    
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name' => 'id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'email',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
               'validators' => array(
                    array(
                        'name' => 'EmailAddress',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 5,
                            'max' => 255,
                            'message' => 'Email address format is invalid. Use the basic format test@test.com'
                        ),
                    ),
                    array(
                        'name'    => 'Db\NoRecordExists',
                        'options' => array(
                            'table' => 'user',
                            'field' => 'email',
                            'adapter' => \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::getStaticAdapter(),
                            'message' => 'This email address exists',
                            // to perform for new user and already existed one
                            'exclude' => array(
                                'field' => 'id',
                                'value' => $this->id ?: 1
                            )
                        ),
                    ),                   
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'password',
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                ),
               'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 5,
                            'max' => 128,
                        ),
                    ),
                ),
            )));            

            $inputFilter->add($factory->createInput(array(
                'name' => 'firstname',
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 2,
                            'max' => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'lastname',
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 2,
                            'max' => 100,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }    
    
    /**
     * Get data as array
     * 
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}
