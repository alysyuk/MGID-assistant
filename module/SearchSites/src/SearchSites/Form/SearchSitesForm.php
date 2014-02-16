<?php

namespace SearchSites\Form;
 
use Zend\Form\Form;
 
class SearchSitesForm extends Form
{
    
    public function __construct()
    {
        parent::__construct('search');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'type' => 'radio',
            'name' => 'search_type',
            'options' => array(
                'label' => 'Choose search type:',
                'value_options' => array(
                    '0' => 'Search sites(similarsites.com,xmarks.com)',
                    '1' => 'Search engines(google,yahoo)',
                    '2' => 'Ispionage'
                )
            ),
            'attributes' => array(
                'value' => '0' //set checked to '1'
            )                
        ));

        $this->add(array(
            'type'  => 'text',
            'name' => 'search_by',
            'options' => array(
                'label' => 'Site name/keyword',
            ),
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
        ));
        
        $this->add(array(
            'type'  => 'text',
            'name' => 'alexa_rate',
            'options' => array(
                'label' => 'Alexa rate(no delimiters: 2000, 10000, etc)',
            ),
        ));        
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Search',
                'id' => 'submitbutton',
            ),
        ));
    }
}