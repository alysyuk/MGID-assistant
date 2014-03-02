<?php

namespace SearchSites\SearchProcessor\SearchType;

use SearchSites\Form\SearchSitesFieldset;
use Zend\Dom\Query;
use Zend\Http\Client as HttpClient;

abstract class AbstractSearchType implements SearchTypeInterface
{
    private $searchBy;
    private $iteration;
    private $alexaRateFrom;
    private $alexaRateTo;

    /**
     * @var Query Zend\Dom\Query instance
     */    
    private $queryDom;
    
    /**
     * @var HttpClient Zend\Http\Client instance
     */
    private $httpClient;

    protected static $obligatoryParametersForPerformigSearch = array(
        SearchSitesFieldset::SEARCH_BY,
        SearchSitesFieldset::ITERATION,
        SearchSitesFieldset::ALEXA_RATE_FROM,
        SearchSitesFieldset::ALEXA_RATE_TO,
    );    
    
    /**
     * Constructor
     * 
     * @param array $data Data passed from form
     * @throws \InvalidArgumentException
     */
    public function __construct(array $data)
    {
        try {
            $this->validateSearchParameters($data);
        } catch (\InvalidArgumentException $objException) {
            throw $objException;
            // @todo: log the error
//            $this->logError('Empty required argument: ' . $objException->getMessage());
        }
        
        $this->setSearchParameters($data)
             ->setQueryDom()
             ->setHttpClient()   
        ;

    }
    
    /**
     * Sets passed search data 
     * 
     * @param array $data Data passed from form
     * @return AbstractSearchType
    */
    public function setSearchParameters(array $data) {
        array_walk($data, function ($key, $value) {
            switch ($value) {
                case SearchSitesFieldset::SEARCH_BY:
                    $this->searchBy = $key;

                    break;
                case SearchSitesFieldset::ITERATION:
                    $this->iteration = $key;

                    break;
                case SearchSitesFieldset::ALEXA_RATE_FROM:
                    $this->alexaRateFrom = $key;

                    break;
                case SearchSitesFieldset::ALEXA_RATE_TO:
                    $this->alexaRateTo = $key;

                    break;

                default:
                    break;
            }
        });
        
        return $this;
    }
    
    public function performSearching() {
    }
    
    /**
     * Validates passed search data
     * 
     * @param array $data
     * @throws \InvalidArgumentException
     */
    public function validateSearchParameters(array $data)
    {
        $obligatoreFileds = self::$obligatoryParametersForPerformigSearch;

        foreach ($obligatoreFileds as $field) {
            if (!array_key_exists($field, $data)) {
                throw new \InvalidArgumentException($field);
            }
        }
    }
    
    /**
     * Sets Zend\Dom\Query instance
     * 
     * @return AbstractSearchType
     */
    protected function setQueryDom() {
        if (!$this->queryDom) {
            $this->queryDom = new Query();
        }
        
        return $this;
    }
    
    /**
     * Sets Zend\Http\Client instance
     * 
     * @return AbstractSearchType
     */
    protected function setHttpClient() {
        if (!$this->httpClient) {
            $this->httpClient = new HttpClient();
        }
        
        return $this;
    }
    
    /**
     * @return HttpClient Zend\Http\Client instance
     */
    public function getHttpClient() 
    {
        return $this->httpClient;
    }    
    
    /**
     * @return Query Zend\Dom\Query instance
     */
    public function getQueryDom()
    {
        return $this->queryDom;
    }    
    
    /**
     * @return string searchBy
     */
    public function getSearchBy()
    {
        return $this->searchBy;
    }
    
    /**
     * @return string iteration
     */
    public function getIteration()
    {
        return $this->iteration;
    }
    
    /**
     * @return array Alexa range (from, to)
     */
    public function getAlexaRange()
    {
        return array ($this->alexaRateFrom, $this->alexaRateTo);
    }
    
}
