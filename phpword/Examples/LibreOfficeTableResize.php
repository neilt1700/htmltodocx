<?php
require_once '../PHPWord.php';

// New Word Document
$PHPWord = new PHPWord();

// New portrait section
$section = $PHPWord->createSection($sectionStyle);
$table = $section->addTable();

for($r = 1; $r <= 10; $r++) { // Loop through rows
	// Add row
	$table->addRow();
	
	for($c = 1; $c <= 5; $c++) { // Loop through cells
		// Add Cell
		$table->addCell(2750)->addText("Row $r, Cell $c");
	}
}

// This setting only has an effect when using Libre Office. 
// Word will always reduce the size of oversized tables to
// fit the available width when opening a file created by
// PHPWord.
$sectionStyle = array('reduceTableWidthsToFit' => false);
// New portrait section
$section = $PHPWord->createSection($sectionStyle);
$table = $section->addTable();

for($r = 1; $r <= 10; $r++) { // Loop through rows
  // Add row
  $table->addRow();
  
  for($c = 1; $c <= 5; $c++) { // Loop through cells
    // Add Cell
    $table->addCell(2750)->addText("Row $r, Cell $c");
  }
}

// Save File
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save('tmp/LibreOfficeTableResize.docx');
?>