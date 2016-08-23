<?php

class MY_Controller extends CI_Controller {
    public $data = array();
    protected $_log_folder = 'core_engine/application/logs/';
    protected $_log_text = 'site.log';
    
    protected $_LOG_TYPE_GENERAL     = 'GEN';
    protected $_LOG_TYPE_CHECKING    = 'CHE';
    protected $_LOG_TYPE_INFO        = 'INF';
    protected $_LOG_TYPE_TRANSACTION = 'TRN';
    protected $_LOG_TYPE_WARNING     = 'WAR';
    protected $_LOG_TYPE_ERROR       = 'ERR';
            
    function __construct() {
        parent::__construct();
        $this->_init_log();
        $this->load->helper(array('general','security'));
    }
    
    protected function _init_log() {
        $curent_url = current_url();
        $this->_write_log('---------------------------------------------------------------------------');
        $this->_write_log('URL visit : '.$curent_url);
//        $this->_write_log('User ID   : '.$this->session->userdata('user_id'));
//        $this->_write_log('User Name : '.$this->session->userdata('user_name'));
    }
    
    protected function _write_log($event_name = '', $type = FALSE, $log_file=FALSE){
        if(!$type) $type = $this->_LOG_TYPE_GENERAL;
        
        $type = strtoupper($type);
        
        $upload_path = rtrim($this->_log_folder, '/') . '/' . date('Ym') . '/';

        //ensure path is exist
        if (!file_exists($upload_path)) {
            $oldumask = umask(0);
            if (!mkdir($upload_path, 0777, TRUE)) {
                $this->_last_error = 'Cannot create folder ' . $upload_path;
                return FALSE;
            }
            umask($oldumask);
        }
        
        if(!$log_file) {
            $log_file = $upload_path . date('Y-m-d').'_'.$this->_log_text;
        } else {
            $log_file = $upload_path . date('Y-m-d').'_'.$log_file;
        }
        
        $content = array(
            date('Y-m-d H:i:s'),
            $this->input->ip_address(),
            $type,
            $event_name
        );
        
        if ($fp = @fopen($log_file, 'a')){
            fputcsv($fp, $content, "\t");
            fclose($fp);
        }
    }
}

