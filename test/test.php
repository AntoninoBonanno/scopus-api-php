<?php

use Scopus\ScopusApi;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './vendor/autoload.php';

// replace with your API key
$apiKey = "114ff0c3b57a0ec62e15efdedefd2e6f";

$api = new ScopusApi($apiKey);
$results = $api
    ->query("af-id(60071066)")
    ->start(0)
    ->count(5)
    ->viewComplete()
    ->search();

var_dump($results);

foreach ($results->getEntries() as $entry) {
    $abstractUrl = $entry->getLinks()->getSelf();
    $abstract = $api->retrieve($abstractUrl);
    
    var_dump($abstract);

    $authors = $entry->getAuthors();
    foreach ($authors as $author) {
        $authorUrl = $author->getUrl();
        $author = $api->retrieve($authorUrl);
        
        var_dump($author);
    }
}
