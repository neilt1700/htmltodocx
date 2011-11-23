<?php
/**
*  Example of use of HTML converter with PHPWord
*/

require_once 'phpword/PHPWord.php';
require_once 'simplehtmldom/simple_html_dom.php';
require_once 'htmlconverter/h2d_htmlconverter.php';
require_once 'example_files/styles.inc';

// HTML fragment we want to parse:
$html = file_get_contents('example_files/example_html.html');
 
// New Word Document
$phpword_object = new PHPWord();
$section = $phpword_object->createSection();

// HTML Dom object:
$html_dom = new simple_html_dom();
$html_dom->load('<html><body>' . $html . '</body></html>');
// Note, we needed to nest the html in a couple of dummy elements

// Create the dom array of elements which we are going to work on:
$html_dom_array = $html_dom->find('html',0)->children();

// Provide some initial settings:

$initial_state = array(
      'current_style' => array('size' => '11'),
      'style_sheet' => h2d_styles(),
      'parents' => array(0 => 'body'), // Our parent is body
      'list_depth' => 0, // This is the current depth of any current list
      'context' => 'section', // Possible values - section, footer or header
      'base_root' => 'http://test.local', // Required for link elements
      'base_path' => '/', // Required for link elements
      'pseudo_list' => TRUE, // Word lists not yet supported
      'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font
      'pseudo_list_indicator_font_size' => '7', // Bullet indicator size
      'pseudo_list_indicator_character' => 'l ', // Gives a circle bullet point with wingdings
      );    

h2d_insert_html($section, $html_dom_array[0]->nodes, $initial_state);


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
  
?>
