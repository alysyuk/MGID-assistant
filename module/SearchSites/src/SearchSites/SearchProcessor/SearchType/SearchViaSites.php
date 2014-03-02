<?php

namespace SearchSites\SearchProcessor\SearchType;

class SearchViaSites extends AbstractSearchType
{

    const SIMILARSITES_URL = 'http://www.similarsites.com/site/';
    const XMARKS_URL = 'http://www.xmarks.com/site/';

    public function performSearching()
    {
        
        $client = $this->getHttpClient();
        $client->setUri(self::SIMILARSITES_URL . $this->getSearchBy());
        $result = $client->send();
        $body = $result->getBody();
        
//        $testHtml = '<h3><img src="wow/img.jpg" /><a href="http://wow.com">wow link</a></h3>';
//
//        $dom = $this->getQueryDom();
//        $dom->setDocument($testHtml);
//        // get a element using css child selector
//        $result = $dom->execute('h3 > a');
//        var_dump($result->current()->getAttribute('href')); die;
        
        

        $queryDom = $this->getQueryDom();
        $queryDom->setDocumentHtml($body);
        $results = $queryDom->execute('.similarSites .similarSitesList .result .result-content-wrapper .link');
        var_dump($results->count()); die;
        $count = count($results->current()); // get number of matches: 4
        foreach ($results as $result) {
            var_dump($result->textContent);
            // $result is a DOMElement
        }
        
    }

}
