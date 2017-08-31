<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Eugen Stranz, Max Galt
 * @link ${PHING.VM.MAINTAINERURL}
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 9505 2017-04-20 07:24:48Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

/* Let's see if we found the product */
if (empty($this->product)) {
	echo vmText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
	echo '<br /><br />  ' . $this->continue_link_html;
	return;
}

echo shopFunctionsF::renderVmSubLayout('askrecomjs',array('product'=>$this->product));



if(vRequest::getInt('print',false)){ ?>
<body onload="javascript:print();">
<?php } ?>

<div class="product-container productdetails-view productdetails" >

	<div class="gallery">
		<div class="vm-product-media-container">
	<?php
	echo $this->loadTemplate('images');
	?>

	<?php
		$count_images = count ($this->product->images);
		if ($count_images > 1) {
			echo $this->loadTemplate('images_additional');
		}

		// event onContentBeforeDisplay
		echo $this->product->event->beforeDisplayContent; ?>
		</div>
	</div>

	<div class="general-info" id="cost">
    <?php // Product Title   ?>
    <h1 itemprop="name"><?php echo $this->product->product_name ?></h1>
    <?php // Product Title END   ?>
		<span class="item-number">Item Number:
    <?php
		echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'Item Number'));
        ?></span>

				<?php
				// echo shopFunctionsF::renderVmSubLayout('rating', array('showRating' => $this->showRating, 'product' => $this->product));

				$productDisplayTypes = array('productDisplayShipments', 'productDisplayPayments');
				foreach ($productDisplayTypes as $productDisplayType) {

					if(empty($this->$productDisplayType)){
						continue;
					} else if (!is_array($this->$productDisplayType)) {
						$this->$productDisplayType = array($this->$productDisplayType);
					}

					foreach ($this->$productDisplayType as $productDisplay) {

						if(empty($productDisplay)){
							continue;
						} else if (!is_array($productDisplay)){
							$productDisplay = array($productDisplay);
						}

						foreach ($productDisplay as $virtuemart_method_id =>$productDisplayHtml) {
							?>
							<div class="<?php echo substr($productDisplayType, 0, -1) ?> <?php echo substr($productDisplayType, 0, -1).'-'.$virtuemart_method_id ?>">
								<?php
								echo $productDisplayHtml;
								?>
							</div>
							<?php
						}
					}
				}

				//In case you are not happy using everywhere the same price display fromat, just create your own layout
				//in override /html/fields and use as first parameter the name of your file
				echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$this->product,'currency'=>$this->currency));
				?>

				<div class="product-short-description">
						<?php
						echo $this->product->product_s_desc;
						?>
				</div>

				<div class="clear"></div>

				<?php
				echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$this->product));

				echo shopFunctionsF::renderVmSubLayout('stockhandle',array('product'=>$this->product));



					?>




		</div>

		<div class="long-description">
			<?php
			//echo ($this->product->product_in_stock - $this->product->product_ordered);
			// Product Description
			if (!empty($this->product->product_desc)) {
					?>
						<div class="product-description" >
			<?php /** @todo Test if content plugins modify the product description */ ?>
			<?php echo $this->product->product_desc; ?>
						</div>
			<?php
				} // Product Description END
			?>
		</div>




    <?php
	echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'onbot'));

  echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'related_products','class'=> 'product-related-products','customTitle' => true ));

	echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'related_categories','class'=> 'product-related-categories'));

	?>

<?php // onContentAfterDisplay event
echo $this->product->event->afterDisplayContent;

// echo $this->loadTemplate('reviews');

// Show child categories
if ($this->cat_productdetails)  {
	echo $this->loadTemplate('showcategory');
}

$j = 'jQuery(document).ready(function($) {
	$("form.js-recalculate").each(function(){
		if ($(this).find(".product-fields").length && !$(this).find(".no-vm-bind").length) {
			var id= $(this).find(\'input[name="virtuemart_product_id[]"]\').val();
			Virtuemart.setproducttype($(this),id);

		}
	});
});';
//vmJsApi::addJScript('recalcReady',$j);

if(VmConfig::get ('jdynupdate', TRUE)){

	/** GALT
	 * Notice for Template Developers!
	 * Templates must set a Virtuemart.container variable as it takes part in
	 * dynamic content update.
	 * This variable points to a topmost element that holds other content.
	 */
	$j = "Virtuemart.container = jQuery('.productdetails-view');
Virtuemart.containerSelector = '.productdetails-view';
//Virtuemart.recalculate = true;	//Activate this line to recalculate your product after ajax
";

	vmJsApi::addJScript('ajaxContent',$j);

	$j = "jQuery(document).ready(function($) {
	Virtuemart.stopVmLoading();
	var msg = '';
	$('a[data-dynamic-update=\"1\"]').off('click', Virtuemart.startVmLoading).on('click', {msg:msg}, Virtuemart.startVmLoading);
	$('[data-dynamic-update=\"1\"]').off('change', Virtuemart.startVmLoading).on('change', {msg:msg}, Virtuemart.startVmLoading);
});";

	vmJsApi::addJScript('vmPreloader',$j);
}

echo vmJsApi::writeJS();

if ($this->product->prices['salesPrice'] > 0) {
  echo shopFunctionsF::renderVmSubLayout('snippets',array('product'=>$this->product, 'currency'=>$this->currency, 'showRating'=>$this->showRating));
}

?>
</div>
