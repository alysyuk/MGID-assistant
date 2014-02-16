<?php

namespace SearchSites\Form;
 
use Zend\Form\Form;
 
class SearchSitesForm extends Form
{
    
    public function __construct()
    {
        parent::__construct('search');

        $this->setAttribute('method', 'post')
             ->add(new SearchSitesFieldset())
             ->add(array(
                 'name' => 'submit',
                 'attributes' => array(
                     'type'  => 'submit',
                     'value' => 'Search',
                     'id' => 'submitbutton',
                 ),
             ));
    }
    
}