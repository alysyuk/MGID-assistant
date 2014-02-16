<?php

namespace SearchSites\Model;

class Sites
{

    public $id;
    public $domain;
    public $added_at;

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
            $this->{$userProperty} = isset($data[$userProperty]) ? $data[$userProperty] : null;
        }

        // setting date
        if (empty($data['added_at'])) {
            $this->added_at = time();
        }
    }

}
