<?php

require_once('locallib.php');

$storefactory = new local_strathmetadata_store_factory();
$store = $storefactory->getStore(true);

$sourcefile = __DIR__."/metadata.ttl";
$sourcefileuri = 'file:///' . str_replace('\\', '/', realpath($sourcefile));
echo $sourcefileuri;
$result = $store->query("DELETE FROM <http://data.strath.ac.uk/id/dataset/metadata>");
$result = $store->query("LOAD <$sourcefileuri> INTO <http://data.strath.ac.uk/id/dataset/metadata>");
