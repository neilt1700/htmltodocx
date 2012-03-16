<?php
/**
*  Example of use of HTML to docx converter
*/

// Load the files we need:
require_once 'phpword_utf8_test/PHPWord.php';
require_once '../../simplehtmldom/simple_html_dom.php';
require_once '../../htmlconverter/h2d_htmlconverter.php';
require_once '../../example_files/styles.inc';

$test_ru = "<h1> привет </h1>";

// HTML fragment we want to parse:
$html = file_get_contents('utf8-test.html');
 
// New Word Document
$phpword_object = new PHPWord();
$section = $phpword_object->createSection();

// HTML Dom object:
$html_dom = new simple_html_dom();
$html_dom->load('<html><body>' . $html . '</body></html>');
// Note, we needed to nest the html in a couple of dummy elements

// Create the dom array of elements which we are going to work on:
$html_dom_array = $html_dom->find('html',0)->children();

//DebugBreak();

/*
ob_start();
var_dump($html_dom_array[0]->nodes[0]->nodes[0]->_[4]);
$test_output = utf8_decode('Ð¿ÑÐ¸Ð²ÐµÑ');
ob_end_clean();
print test_html_page($test_output);
return;
*/


// Provide some initial settings:
$initial_state = array(
      'current_style' => array('size' => '11'),
      'style_sheet' => h2d_styles_example(), // This is an array (the "style sheet") - returned by h2d_styles_Example() here (in styles.inc) - see this function for an example of how to construct this array.
      'parents' => array(0 => 'body'), // Our parent is body
      'list_depth' => 0, // This is the current depth of any current list
      'context' => 'section', // Possible values - section, footer or header
      'base_root' => 'http://test.local', // Required for link elements - change it to your domain
      'base_path' => '/', // Path from base_root to whatever url your links are relative to
      'pseudo_list' => TRUE, // NOTE: Word lists not yet supported (TRUE is the only option at present)
      'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font
      'pseudo_list_indicator_font_size' => '7', // Bullet indicator size
      'pseudo_list_indicator_character' => 'l ', // Gives a circle bullet point with wingdings
      );    

// Convert the HTML and put it into the PHPWord object
h2d_insert_html($section, $html_dom_array[0]->nodes, $initial_state);

// Clear the HTML dom object:
$html_dom->clear(); 
unset($html_dom);

// Save File
$h2d_file_uri = tempnam('', 'htd');
$objWriter = PHPWord_IOFactory::createWriter($phpword_object, 'Word2007');
$objWriter->save($h2d_file_uri);

// Download the file:
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=example.docx');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($h2d_file_uri));
ob_clean();
flush();
$status = readfile($h2d_file_uri);
unlink($h2d_file_uri);
exit;

function test_html_page($content) {
  
  $output = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Lang" content="en">
<meta name="author" content="">
<meta http-equiv="Reply-to" content="@.com">
<meta name="generator" content="PhpED 5.6">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="creation-date" content="11/11/2008">
<meta name="revisit-after" content="15 days">
<title>Test</title>
<link rel="stylesheet" type="text/css" href="my.css">
</head>
<body>';

$output .= $content;

$output .= '
</body>
</html>';

return $output;
}

function hex_chars($data) {
    $mb_chars = '';
    $mb_hex = '';
    for ($i=0; $i<mb_strlen($data, 'UTF-8'); $i++) {
        $c = mb_substr($data, $i, 1, 'UTF-8');
        $mb_chars .= '{'. ($c). '}';
       
        $o = unpack('N', mb_convert_encoding($c, 'UCS-4BE', 'UTF-8'));
        $mb_hex .= '{'. hex_format($o[1]). '}';
    }
    $chars = '';
    $hex = '';
    for ($i=0; $i<strlen($data); $i++) {
        $c = substr($data, $i, 1);
        $chars .= '{'. ($c). '}';
        $hex .= '{'. hex_format(ord($c)). '}';
    }
    return array(
        'data' => $data,
        'chars' => $chars,
        'hex' => $hex,
        'mb_chars' => $mb_chars,
        'mb_hex' => $mb_hex,
    );
}
function hex_format($o) {
    $h = strtoupper(dechex($o));
    $len = strlen($h);
    if ($len % 2 == 1)
        $h = "0$h";
    return $h;
}
