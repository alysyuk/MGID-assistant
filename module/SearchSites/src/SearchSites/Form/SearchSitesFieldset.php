<?php

namespace SearchSites\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
 
class SearchSitesFieldset extends Fieldset implements InputFilterProviderInterface
{
    
    const SEARCH_SITES = 'SearchViaSites';
    const SEARCH_ENGINES = 'SearchViaEngines';
    const ISPIONAGE = 'SearchViaIspionage';    

    public static $searchOptions = array(
        self::SEARCH_SITES => 'Search sites (similarsites.com,xmarks.com)',
        self::SEARCH_ENGINES => 'Search engines (google,yahoo)',
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
                'required' => 'required'
            )            
        ));
        
        $this->add(array(
            'type'  => 'text',
            'name' => 'alexa_rate_from',
            'options' => array(
                'label' => 'Alexa rate (example: 1000 - 10000)',
            ),
            'attributes' => array(
                'required' => 'required'
            )            
        ));
        
        $this->add(array(
            'type'  => 'text',
            'name' => 'alexa_rate_to',
            'options' => array(
                'label' => '-',
            ),
            'attributes' => array(
                'required' => 'required'
            )            
        ));        
        
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
                    // to use 'break_chain_on_failure' parameter
                    array(
                        'name' => 'digits',
                        'break_chain_on_failure' => true,
                    ),
                    
                    new \Zend\Validator\Between(array('min' => 1, 'max' => 10)),
                ),
            ),
            
            'alexa_rate_from' => array(
                'required' => true,
                'validators' => array(
                    new \Zend\Validator\Digits(),
                ),
            ),
            
            'alexa_rate_to' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'digits',
                        'break_chain_on_failure' => true,
                    ),                    
                    array(
                        'name' => 'Callback',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\Callback::INVALID_VALUE => 
                                'End value of Alexa range should be more than start value',
                            ),
                            'callback' => function($value, $context = array()) {
                                return $value > $context['alexa_rate_from'];
                            },
                        ),
                    ),                    
                ),
            ),
        );
    }

}