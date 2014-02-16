<?php

namespace SearchSites\Form;
 
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
 
class SearchSitesFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    const SEARCH_SITES = 'search_sites';
    const SEARCH_ENGINES = 'search_engines';
    const ISPIONAGE = 'Ispionage';    

    public static $searchOptions = array(
        self::SEARCH_SITES => 'Search sites(similarsites.com,xmarks.com)',
        self::SEARCH_ENGINES => 'Search engines(google,yahoo)',
        self::ISPIONAGE => 'Ispionage'
    );    
    
    public function __construct()
    {
        parent::__construct('fieldset');

        $this->add(array(
            'type' => 'radio',
            'name' => 'search_option',
            'options' => array(
                'label' => 'Choose search option:',
                'value_options' => self::$searchOptions
            ),
            'attributes' => array(
                'value' => self::SEARCH_SITES
            )                
        ));

        $this->add(array(
            'type'  => 'text',
            'name' => 'search_by',
            'options' => array(
                'label' => 'Site name/keyword',
            ),
            'attributes' => array(
                'required' => 'required'
            )            
        ));

        $this->add(array(
            'type'  => 'text',
            'name' => 'domain',
            'options' => array(
                'label' => 'National domain',
            ),
        ));
        
        $this->add(array(
            'type'  => 'text',
            'name' => 'iteration',
            'options' => array(
                'label' => 'Iteration amount',
            ),
            'attributes' => array(
//                'required' => 'required'
            )            
        ));
        
//        $this->add(array(
//            'type'  => 'text',
//            'name' => 'alexa_rate',
//            'options' => array(
//                'label' => 'Alexa rate(no delimiters: 2000, 10000, etc)',
//            ),
//            'attributes' => array(
//                'required' => 'required'
//            )            
//        ));        
        
    }
    
    /**
     * {@inheritdoc}
     */    
    public function getInputFilterSpecification()
    {
        return array(
            'search_by' => array(
                'required' => true
            ),
            
            'iteration' => array(
                'required' => true,
                'validators' => array(
                    new \Zend\Validator\Digits(),
                    new \Zend\Validator\Between(array('min' => 1, 'max' => 10)),
                ),
                'filters' => array(
                    array('name' => 'Zend\Filter\Int'),
                ),                
            ),
            
//            'alexa_rate' => array(
//                'required' => true,
//                'validators' => array(
//                    new \Zend\Validator\Digits(),
//                ),
//                'filters' => array(
//                    array('name' => 'Zend\Filter\Int'),
//                ),
//            )
        );
    }

}