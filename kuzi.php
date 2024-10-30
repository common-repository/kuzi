<?php

/**
 * @package metadoll
 * @version 1.0.1
 */
/*
  Plugin Name: 困ったときの他人任せ
  Plugin URI: http://tips.recatnap.info/
  Description: 選択するのが面倒なときに他人任せで決定するプラグイン。
  Author: metadoll
  Version: 1.0.1
  Author URI: http://tips.recatnap.info/
 */

/**
 * jQueryの読み込み
 */
function wp_enqueue_myScripts(){
    wp_enqueue_script("jquery");
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_myScripts');

class KuziClass {
    public $tmpMyUrl;
    public $tmpMyPath;

    function __construct() {
        $this->tmpMyUrl = WP_PLUGIN_URL . '/' . str_replace(basename(__FILE__), "", plugin_basename(__FILE__));
        $this->tmpMyPath = dirname(__FILE__);
        
        require_once $this->tmpMyPath . "/kuzi_html.php";
        
        $this->outputKuzi();
    }
    
    function outputKuzi(){
        $reelAry = array();
        $reelAry[] = "(●｀･ω･)ゞOK/Yes";
        $reelAry[] = "(*≧∇≦)ﾉOK/Yes";
        $reelAry[] = "(〃ω〃)OK/Yes";
        $reelAry[] = "(○´∀｀)σOK/Yes";
        $reelAry[] = "壁|▽//)ゝOK/Yes";
        $reelAry[] = "(〃ﾉ∀ﾉ)OK/Yes";
        $reelAry[] = "(o´ω｀o)OK/Yes";
        $reelAry[] = "(*･З･｀)OK/Yes";
        $reelAry[] = "(っ･ω･)っOK/Yes";
        $reelAry[] = "ヾﾉ-ω-｀)NG/No";
        $reelAry[] = "(｡｀-д-)NG/No";
        $reelAry[] = "ヽ(*｀Д´)ﾉNG/No";
        $reelAry[] = "(；*´Д`)NG/No";
        $reelAry[] = "(*｀ε´*)ﾉNG/No";
        $reelAry[] = "(●｀з´●)NG/No";
        $reelAry[] = "(´;д;)qNG/No";
        $reelAry[] = "ο（´･ε･｀○）NG/No";
        $reelAry[] = "(。￣ｘ￣。)NG/No";
        
        $obj = array();
        $obj["BaseUrl"] = $this->tmpMyUrl;
        $obj["ReelAry"] = $reelAry;
        outputSource($obj);
    }

}

function mtdKuzi() {
    new KuziClass();
}




?>
