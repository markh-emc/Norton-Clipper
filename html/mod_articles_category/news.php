<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<ul class="category-module<?php echo $moduleclass_sfx; ?> owl-carousel news-slide owl-theme">
	<?php if ($grouped) : ?>
		<?php foreach ($list as $group_name => $group) : ?>
		<li>
			<div class="mod-articles-category-group"><?php echo $group_name;?></div>
			<ul>
				<?php foreach ($group as $item) : ?>
					<li>
						<?php if ($params->get('link_titles') == 1) : ?>
							<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
								<?php echo $item->title; ?>
							</a>
						<?php else : ?>
							<?php echo $item->title; ?>
						<?php endif; ?>

						<?php if ($item->displayHits) : ?>
							<span class="mod-articles-category-hits">
								(<?php echo $item->displayHits; ?>)
							</span>
						<?php endif; ?>

						<?php if ($params->get('show_author')) : ?>
							<span class="mod-articles-category-writtenby">
								<?php echo $item->displayAuthorName; ?>
							</span>
						<?php endif;?>

						<?php if ($item->displayCategoryTitle) : ?>
							<span class="mod-articles-category-category">
								(<?php echo $item->displayCategoryTitle; ?>)
							</span>
						<?php endif; ?>

						<?php if ($item->displayDate) : ?>
							<!-- <span class="mod-articles-category-date"><?php echo $item->displayDate; ?></span> -->
						<?php endif; ?>

						<?php if ($params->get('show_introtext')) : ?>
							<p class="mod-articles-category-introtext">
								<?php echo $item->displayIntrotext; ?>
							</p>
						<?php endif; ?>

						<?php if ($params->get('show_readmore')) : ?>
							<p class="mod-articles-category-readmore">
								<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
									<?php if ($item->params->get('access-view') == false) : ?>
										<?php echo JText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE'); ?>
									<?php elseif ($readmore = $item->alternative_readmore) : ?>
										<?php echo $readmore; ?>
										<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
											<?php if ($params->get('show_readmore_title', 0) != 0) : ?>
												<?php echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit')); ?>
											<?php endif; ?>
									<?php elseif ($params->get('show_readmore_title', 0) == 0) : ?>
										<?php echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE'); ?>
									<?php else : ?>
										<?php echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE'); ?>
										<?php echo JHtml::_('string.truncate', ($item->title), $params->get('readmore_limit')); ?>
									<?php endif; ?>
								</a>
							</p>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</li class="item">
		<?php endforeach; ?>
	<?php else : ?>
		<?php foreach ($list as $item) : ?>
			<li class="item">
				<div class="news-image">
					<?php
						  if ($module->showtitle)
						  {
						    echo '<h3>' .$module->title .'</h3>';
						  }
						?>

				<?php
					// turn image data string into array
					$item->images = str_replace('"', '', $item->images);
					$image = explode(',',$item->images);
					$image_value = [];
					foreach ($image as $key => $value) {
						array_push($image_value, explode(':', $value));
					}

				 ?>
				<?php if ($params->get('link_titles') == 1 && !empty($image_value[0][1])) : ?>
					<!-- <a class="mod-articles-category-img <?php echo $item->active; ?>" href="<?php echo $item->link; ?>"> -->
						<img src="<?php echo $image_value[0][1]; ?>" alt="<?php echo ($image_value[2][1] ? $image_value[2][1] : ''); ?>" title="<?php echo ($image_value[2][1] ? $image_value[2][1] : ''); ?>" class="art-intro-img" />
					<!-- </a> -->
				<?php elseif (!empty($image_value[0][1])) : ?>
					<img src="<?php echo $image_value[0][1]; ?>" alt="<?php echo ($image_value[2][1] ? $image_value[2][1] : ''); ?>" title="<?php echo ($image_value[2][1] ? $image_value[2][1] : ''); ?>" class="art-intro-img" />
				<?php endif; ?>
				</div>
				<div class="news-content">
					<div class="cat-date">
						<span class="title"><?php echo $item->displayCategoryTitle; ?></span> |
						<span class="date"><?php echo $item->displayDate; ?></span>
					</div>
					<div class="tile-content">
						<h3><?php echo $item->title; ?></h3>
						<?php if ($params->get('show_introtext')) : ?>
									 <p class="mod-articles-category-introtext">
											 <?php echo $item->displayIntrotext . ' '; ?>
										 </p>
							 <?php endif; ?>
						    <a class="button" href="<?php echo $item->link; ?>">View Post</a>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>
