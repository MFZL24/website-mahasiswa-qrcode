<?php
class Template {
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function load($template = '', $view = '', $view_data = array(), $return = FALSE) {
        $this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
        
        // Gabungkan data agar variabel di $view_data juga bisa diakses di template.php jika perlu
        $final_data = array_merge($this->template_data, $view_data);
        
        return $this->CI->load->view($template, $final_data, $return);
    }

    protected $template_data = array();

    public function set($name, $value) {
        $this->template_data[$name] = $value;
    }
}
