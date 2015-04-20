<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Controller
 *
 * @author Tsotsi
 */
class TT_Controller extends CI_Controller {

    //put your code here
    protected $_header = 'layouts/header';
    protected $_footer = 'layouts/footer';
    private $_is_layout = true;
    private $_vars = array(
        'title' => 'My_APP',
        'keywords' => '',
        'description' => ''
    );
    private $_css_js_files = array();

    public function __construct()
    {
        parent::__construct();
        /**
         * asset dir
         * 资源文件目录
         */
        define('ASSETPATH', rtrim(config_item('base_url'), '/\\') .'/asset/');
        $this->_css_js_files = $this->_my_js_css();
        $this->_init();
    }

    public function _output($output)
    {
        if (!$this->_is_layout)
        {
            echo $output;
        } else
        {
            $vars = $this->load->get_vars();
            $this->load->vars(array_merge($vars, $this->_vars));
            echo $this->_init();
            echo $output;
            echo $this->load->view($this->_footer, array(), true);
        }
    }

    private function _init()
    {
        $_header_html = $this->load->view($this->_header, array(), true);
        $_tmp = '';
        foreach ($this->_css_js_files as $src => $file)
        {
            switch ($file['type'])
            {
                case 'js':
                    $_tmp.=isset($file['charset']) && !empty($file['charset']) ? $this->_js_tag($src, $file['charset']) : $this->_js_tag($src);
                    break;
                case 'css':
                    $_tmp.=isset($file['charset']) && !empty($file['charset']) ? $this->_css_tag($src, $file['charset']) : $this->_css_tag($src);
                    break;

                default:
                    trigger_error("{$file['type']} is not support type");
                    break;
            }
        }
        if (!empty($_tmp))
        {
            $_header_html = preg_replace('/(\<head[^\>]*?\>)/i', '$1' . $_tmp, $_header_html);
        }
        return $_header_html;
    }

    private function _css_tag($href = '', $charset = 'utf-8')
    {
        $result = '';
        if (!empty($href))
        {
            $result = "<link href='{$href}' rel='stylesheet' type='text/css' charset='{$charset}' />";
        }
        return $result;
    }

    private function _js_tag($src = '', $charset = 'utf-8')
    {
        $result = '';
        if (!empty($src))
        {
            $result = "<script src='{$src}'  type='text/javascript' charset='{$charset}' ></script>";
        }
        return $result;
    }

    protected function _css_jss_load($src = '', $type = 'js', $charset = 'utf-8')
    {
        $this->_css_js_files[$src] = array('type' => $type, 'charset' => $charset);
    }

    public function _my_js_css()
    {
        return array(
            ASSETPATH . 'js/jquery/jquery.min.js' => array(
                'type' => 'js'
            ),
            ASSETPATH . 'js/jquery/jquery.easing.1.3.min.js' => array(
                'type' => 'js'
            ),
            ASSETPATH . 'js/jquery/jquery.widget.min.js' => array(
                'type' => 'js'
            ),
            ASSETPATH . 'js/jquery/jquery.mousewheel.js' => array(
                'type' => 'js'
            ),
            ASSETPATH . 'js/jquery/jquery.dataTables.js' => array(
                'type' => 'js'
            ),
            ASSETPATH . 'js/metro.min.js' => array(
                'type' => 'js'
            ),
            ASSETPATH . 'css/metro-bootstrap.min.css' => array(
                'type' => 'css'
            ),
            ASSETPATH . 'css/metro-bootstrap-responsive.min.css' => array(
                'type' => 'css'
            ),
            ASSETPATH . 'css/iconFont.min.css' => array(
                'type' => 'css'
            ),
        );
    }

    protected function seo_set($key, $value)
    {
        $flag = false;
        if (array_key_exists($key, $this->_vars))
        {
            $this->_vars[$key] = $value;
            $flag = true;
        }
        return $flag;
    }

    public function set_is_layout($status = true)
    {
        $this->_is_layout = $status;
    }

}
