<?php // no direct access
defined ('_JEXEC') or die('Restricted access');
// add javascript for price and cart, need even for quantity buttons, so we need it almost anywhere
vmJsApi::jPrice();

?>
<ul class="owl-carousel related-slide owl-theme">
	<?php foreach ($products as $product) : ?>
	<li>
		<div class="image">
			<?php
			if (!empty($product->images[0])) {
				$image = $product->images[0]->displayMediaThumb ('class="featuredProductImage"', FALSE);
			} else {
				$image = '';
			}
			echo $image; ?>

		</div>

		<div class="category">
			<p>
				Diamond Blades
			</p>


		</div>

		<div class="product-content">
			<h4><?php echo $product->product_name; ?></h4>

			<?php echo shopFunctionsF::limitStringByWord($product->product_s_desc, 100) ?>

			<?php
			$url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' .$product->virtuemart_category_id); ?>
			<a href="<?php echo $url ?>">View Product</a>        <?php   ;
			?>
		</div>
	</li>
	<?php
endforeach; ?>
</ul>
