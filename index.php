<?php
/**
 * @brief
 * Main handler file, contains all HTML code
 * @file
 * This is the main output file, the file that calls all other functions.
 * This file should not need to be modified very often.
 */

// Disable non-fatal errors
error_reporting(E_ERROR);

require 'include/pear.inc';
require_once 'include/xmlrpc.inc';
require_once 'include/form.inc';
require_once 'include/barcode.inc';
require_once 'include/product.inc';

/**
 * Set to TRUE to output debug info
 */
$debug = FALSE;
/**
 * The Google AJAX search API key
 * @see http://code.google.com/apis/ajaxsearch/signup.html
 */
define('APIKEY', 'YOURKEYHERE');
/**
 * isbndb.com API key
 * @see https://isbndb.com/account/dev/keys/generate.html
 */
define('ISBNKEY', 'YOURKEYHERE');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content=
  "text/html; charset=us-ascii" />
  <meta name="Language" content="English" />

  <!-- Styles -->
  <link type="text/css" rel="stylesheet" href="style.css" />
  <link type="text/css" rel="stylesheet" href="form.css" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

  <!-- Search Providers -->
  <link rel="search" type="application/opensearchdescription+xml" title="UPC Lookup" href="http://upc.dankeenan.org/include/opensearch/opensearch_desc.upc.xml">
  <link rel="search" type="application/opensearchdescription+xml" title="ISBN Lookup" href="http://upc.dankeenan.org/include/opensearch/opensearch_desc.isbn.xml">

  <title>UPC Lookup</title>

  <script type="text/javascript">
    function popup(url, h, w)
    {
      var newwindow=window.open(url,'name','height=' + h + ',width=' + w);
      if (window.focus)
      {
        newwindow.focus();
      }
    }
  </script>
</head>

<body>
  <div id="container">
    <a href="index.php"><div class="mainimage"></div></a>

    <div id="menu">
      <div id="plug"><a href="credits.html" target="_blank" onclick="popup(this.href, 200, 300); return false;">Credits</a></div>
    </div>

    <div id="bodytext">
      <?php
        if (isset($_GET['upc'])) {
          /**
           * Holds the barcode entered
           * @note Can hold any barcode, but named $upc for ease of entry
           */
          $upc = $_GET['upc'];
          if (checkBarcode($upc)) {
            echo getBarcodeInfo($upc);
          }
          else {
            echo <<<_HTML
            <div id="info" class="error">
              The barcode with the value $upc is not valid.
            </div>
_HTML;
          }
        }
        echo getEntryForm();
      ?>
    </div>
  </div>

  <div class="footer">
    <div class="right">
      By <a href="http://dankeenan.org">Dan Keenan</a> | <a href="http://websvn.dankeenan.org/listing.php?repname=UPC+Lookup&path=%2F&sc=0">Source Code</a> | 
      <a href="javascript:window.external.AddSearchProvider('http://upc.dankeenan.org/include/opensearch/opensearch_desc.upc.xml');">Add UPC Search</a> | 
      <a href="javascript:window.external.AddSearchProvider('http://upc.dankeenan.org/include/opensearch/opensearch_desc.isbn.xml');">Add ISBN Search</a>
    </div>
  </div>
</body>
</html>
