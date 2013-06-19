<?php

require_once('../../config.php');
require_once($CFG->dirroot.'/local/strathmeta/lib.php');
require_once($CFG->dirroot.'/local/strathmeta/vendor/semsol/arc2/ARC2.php');

class local_strathmetadata_store_factory {
    
    protected $config;
    
    public function __construct() {
        global $CFG;
        
        $this->config = array(
                /* db */
                'db_host' => $CFG->dbhost, /* default: localhost */
                'db_name' => $CFG->dbname,
                'db_user' => $CFG->dbuser,
                'db_pwd' => $CFG->dbpass,
                /* store */
                'store_name' => $CFG->prefix . 'local_strathmeta_store',
                'bnode_prefix' => 'bn',
                /* sem html extraction */
                'sem_html_formats' => 'rdfa microformats',
        
                /* endpoint */
                'endpoint_features' => array(
                        'select', 'construct', 'ask', 'describe',
                        'load', 'insert', 'delete',
                        'dump' /* dump is a special command for streaming SPOG export */
                ),
                'endpoint_timeout' => 60, /* not implemented in ARC2 preview */
                'endpoint_read_key' => '', /* optional */
                'endpoint_write_key' => 'internal_write_key' /* optional, but without one, everyone can write! */
        );
    }
    
    public function getStore($create = false) {
        $store = ARC2::getStore($this->config);
        
        if ($create && !$store->isSetUp()) {
            $store->setUp();
        }
        
        return $store;
    }
    
    public function getEndpoint($create = false) {
        $ep = ARC2::getStoreEndpoint($this->config);
        
        if ($create && !$ep->isSetUp()) {
            $ep->setUp(); /* create MySQL tables */
        }
        
        return $ep;
    }
    
}