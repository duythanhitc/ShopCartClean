<?php
abstract class Controller {
	protected $registry;
	public function __construct($registry) {
		$this->registry = $registry;
	}

	public function __get($key) {
		return $this->registry->get($key);
	}

	public function __set($key, $value) {
		$this->registry->set($key, $value);
	}
        
        public  function getDataComponent($component_name){
            //html component
            $this->load->model('ltmodule/html');
            $dataFull = $this->model_ltmodule_html->getModule($component_name,'html');
            if($dataFull==null)
                return "";
            //die(var_dump($dataFull[0]['module_id']));
            $dataComponent = json_decode($dataFull[0]['setting'], true);
            if(!isset($this->session->data['token'])){
                $textReturn = html_entity_decode($dataComponent['module_description'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');
            }else{
                $textReturn = "<div class='component-html'>";
                $textReturn .= "<a class='component-html-tool' href='".$this->config->get('config_url').'index.php?id='.$dataFull[0]['module_id']."&route=ltcomponent/html'></a>";
                $textReturn .= html_entity_decode($dataComponent['module_description'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');
                $textReturn .= "</div>";
            }
            return $textReturn;
        }
        
        public  function getFormEdit(){
            if(!isset($this->session->data['token'])){
                $textReturn = "";
            }else{
                $textReturn = "";
                $textReturn .= "<script>$('.component-html-tool').colorbox({iframe:true, innerWidth:'80%', innerHeight:490, onClosed:function(){location.reload();}});</script>";
            }
            return $textReturn;
        }
        
        public function getDataComponentById($component_id){
            //html component
            $this->load->model('ltmodule/html');
            $dataComponent = $this->model_ltmodule_html->getModuleById($component_id,'html');
            if(!isset($this->session->data['token'])){
                $textReturn = "-1";
            }else{
                $dataComponent['url_submit'] = $this->config->get('config_url').'index.php?id='.$component_id.'&route=ltcomponent/html';
                $textReturn = $dataComponent;//html_entity_decode($dataComponent['module_description'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');
            }
            //die(var_dump($textReturn));
            return $textReturn;
        }
}