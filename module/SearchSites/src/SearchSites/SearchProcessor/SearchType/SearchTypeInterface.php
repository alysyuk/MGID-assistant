<?php

namespace SearchSites\SearchProcessor\SearchType;

interface SearchTypeInterface
{
    public function validateSearchParameters(array $data);
    
    public function setSearchParameters(array $data);
    
    public function performSearching();
}
