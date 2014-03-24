<?php

namespace SearchSites\SearchProcessor\SearchType;

class SearchViaSites extends AbstractSearchType
{

    const SIMILARSITES_URL = 'http://www.similarsites.com/site/';
    const XMARKS_URL = 'http://www.xmarks.com/site/';

    public function performSearching()
    {
        
//        $html = '
//            <div class="container">
//               <div class="accordion">
//                Test1
//                <div class="accordion">
//                  Test2
//                    <div class="accordion">
//                        Test3
//                    </div>
//                </div>
//            </div>
//            <div class="accordion">
//                Name
//                <div class="accordion">
//                  Name2
//                    <div class="accordion">
//                        Name3
//                    </div>
//                </div>
//            </div>
//         </div>
//        ';
//
//       $dom = new \Zend\Dom\Query($html);
//       // Will returns the first levels .accordion in .container ($results length is 2)
//        $results = $dom->execute('.container .accordion');
        
        $client = $this->getHttpClient();
        $client->setUri(self::SIMILARSITES_URL . $this->getSearchBy())
               ->setOptions(array(
                   'maxredirects' => 0,
                   'timeout' => 30
               ))
               ->setHeaders(array(
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'User-Agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
               ));
        $result = $client->send();
        $body = $result->getBody();
        file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'test.txt', $body);
        $queryDom = $this->getQueryDom();
        $queryDom->setDocumentHtml($body);

        $results = $queryDom->execute('#similarSites .similarSitesList');
//        $results = $queryDom->execute('.modalDialog h2');
        
//        var_dump($results);
        echo '<pre>';
        print_r($results->current());
        echo '</pre>';

//        print_r($results->current()->textContent);
        die;
//        foreach ($results as $result) {
//            print_r($result->nodeValue);
            // $result is a DOMElement
//        }
        
    }

}
