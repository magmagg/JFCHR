<?php
require_once __DIR__ . '/../src/PhpWord/Autoloader.php';

//date_default_timezone_set('UTC');

/**
 * Header file
 */
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;

error_reporting(E_ALL);
define('CLI', (PHP_SAPI == 'cli') ? true : false);
define('EOL', CLI ? PHP_EOL : '<br />');
define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
define('IS_INDEX', SCRIPT_FILENAME == 'index');

Autoloader::register();
Settings::loadConfig();

// Set writers
$writers = array('Word2007' => 'docx');//, 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html', 'PDF' => 'pdf');

// Set PDF renderer
if (null === Settings::getPdfRendererPath()) {
    $writers['PDF'] = null;
}

// Return to the caller script when runs by CLI
if (CLI) {
    return;
}

// Set titles and names
$pageHeading = str_replace('_', ' ', SCRIPT_FILENAME);
$pageTitle = IS_INDEX ? 'Welcome to ' : "{$pageHeading} - ";
$pageTitle .= 'PHPWord';
$pageHeading = IS_INDEX ? '' : "<h1>{$pageHeading}</h1>";

// Populate samples
$files = '';
if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle))) {
        if (preg_match('/^Sample_\d+_/', $file)) {
            $name = str_replace('_', ' ', preg_replace('/(Sample_|\.php)/', '', $file));
            $files .= "<li><a href='{$file}'>{$name}</a></li>";
        }
    }
    closedir($handle);
}

/**
 * Write documents
 *
 * @param \PhpOffice\PhpWord\PhpWord $phpWord
 * @param string $filename
 * @param array $writers
 *
 * @return string
 */
function write($phpWord, $filename, $writers,$filename,$quitclaimdocumentid)
{
    $result = '';

    // Write documents
    foreach ($writers as $format => $extension) {
        $result .= date('H:i:s') . " Write to {$format} format";
        if (null !== $extension) {
            $targetFile = APPPATH . "quitclaimdocuments\signeddocuments\\$filename";

            $phpWord->save($targetFile, $format);
            $finalfile = $targetFile.$format;
        } else {
            $result .= ' ... NOT DONE!';
        }
        $result .= EOL;
    }

    $result .= getEndingNotes($writers);
    /*

    $targetpdf = APPPATH . "createdwordfile\\".$rand.$filename;
    $rawname = $rand.$filename;

    $word = new COM("Word.Application") or die ("Could not initialise Object.");
				  // set it to 1 to see the MS Word window (the actual opening of the document)
				  $word->Visible = 0;
				  // recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
				  $word->DisplayAlerts = 0;
				  // open the word 2007-2013 document
				  $word->Documents->Open($targetFile);
				  // save it as word 2003
				  $word->ActiveDocument->SaveAs('newdocument.doc');
				  // convert word 2007-2013 to PDF
				  $word->ActiveDocument->ExportAsFixedFormat($targetpdf.'.pdf', 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
				  // quit the Word process
				  $word->Quit(false);
				  // clean up
				  unset($word);

          $FILEPATH = APPPATH . "createdwordfile\\";

          $now = time();
    				$timeupdated = unix_to_human($now);
            */
            $path = APPPATH . "quitclaimdocuments\signeddocuments\\";
          $data = array(
            'quitclaim_document_path'=>$path,
            'quitclaim_document_filename'=>$filename);

            $ci =& get_instance();

            $ci->Model_user->update_quitclaim_document($data,$quitclaimdocumentid);






    return $result;
}



/**
 * Get ending notes
 *
 * @param array $writers
 *
 * @return string
 */
function getEndingNotes($writers)
{
    $result = '';

    // Do not show execution time for index
    if (!IS_INDEX) {
        $result .= date('H:i:s') . " Done writing file(s)" . EOL;
        $result .= date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB" . EOL;
    }

    // Return
    if (CLI) {
        $result .= 'The results are stored in the "results" subdirectory.' . EOL;
    } else {
        if (!IS_INDEX) {
            $types = array_values($writers);
            $result .= '<p>&nbsp;</p>';
            $result .= '<p>Results: ';
            foreach ($types as $type) {
                if (!is_null($type)) {
                    $resultFile = 'results/' . SCRIPT_FILENAME . '.' . $type;
                    if (file_exists($resultFile)) {
                        $result .= "<a href='{$resultFile}' class='btn btn-primary'>{$type}</a> ";
                    }
                }
            }
            $result .= '</p>';
        }
    }

    return $result;
}
?>
