<?php

class ControllerCommonSlide extends Controller {

    public function index() {
        $this->document->setTitle($this->config->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));
        $data['column_left'] = "";
        $this->response->setOutput($this->load->view('common/slide',$data));
    }

}
