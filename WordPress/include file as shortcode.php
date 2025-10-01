/*************************
INCULDE CONTENT OF EXTERNAL FILE

*************************/

add_shortcode('includez', 'include_php_file');
function include_php_file($atts=array(), $content='') {
    $atts = shortcode_atts(array(
        'file' => ''
    ), $atts);

    if(!$atts['file']) return 'No file name, lol'; // needs a file name!
    $file_path = dirname(__FILE__).'/'.$atts['file']; // adjust your path here
    if(!file_exists($file_path)) return 'file not found, lol';

    ob_start();
    include($file_path);
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}

[includez file='filename.php']

//in your current theme folder