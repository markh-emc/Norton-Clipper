<?php
/**
*
* Shows the products/categories of a category
*
* @package	VirtueMart
* @subpackage
* @author Max Milbers
* @link ${PHING.VM.MAINTAINERURL}
* @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
 * @version $Id: default.php 6104 2012-06-13 14:15:29Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$categories = $viewData['categories'];

if ($categories) {

$categories_per_row = !empty($viewData['categories_per_row'])? $viewData['categories_per_row']:VmConfig::get ( 'categories_per_row', 100 );
if(empty($categories_per_row)) $categories_per_row = 100;

// Category and Columns Counter
$iCol = 1;
$iCategory = 1;

// Calculating Categories Per Row
$category_cellwidth = ' width'.floor ( 100 / $categories_per_row );

// Separator
$verticalseparator = " vertical-separator";
?>

<div class="category-view">

<?php

// Start the Output
    foreach ( $categories as $category ) {

	    // Show the horizontal seperator
	    if ($iCol == 1 && $iCategory > $categories_per_row) { ?>

	    <?php }

	    // this is an indicator wether a row needs to be opened or not
	    if ($iCol == 1) { ?>
      <div class="row">
        <?php }

        // Show the vertical separator
        if ($iCategory == $categories_per_row or $iCategory % $categories_per_row == 0) {
          $show_vertical_separator = ' ';
        } else {
          $show_vertical_separator = $verticalseparator;
        }

        // Category Link
        $caturl = JRoute::_ ( 'index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id , FALSE);

          // Show Category ?>
    <div class="category">
        <div class="image">
            <?php // if ($category->ids) {
              echo $category->images[0]->displayMediaThumb("",false);
            //} ?>
        </div>

        <div class="text">
            <h3><?php echo vmText::_($category->category_name) ?></h3>
            <p>

            <?php echo shopFunctionsF::limitStringByWord($category->category_description, 100) ?></p>
            <a class="product-button" href="<?php echo $caturl ?>">
                View Machines
            </a>
        </div>


    </div>
	    <?php
	    $iCategory ++;

	    // Do we need to close the current row now?
        if ($iCol == $categories_per_row) { ?>
    <div class="clear"></div>
	</div>
		    <?php
		    $iCol = 1;
	    } else {
		    $iCol ++;
	    }
    }
	// Do we need a final closing row tag?
	if ($iCol != 1) { ?>
		<div class="clear"></div>
	</div>
	<?php
	}
	?></div><?php
 } ?>
