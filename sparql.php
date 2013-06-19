<?php

require_once('locallib.php');

$storefactory = new local_strathmetadata_store_factory();
$storeep = $storefactory->getEndpoint(true);

$storeep->go();