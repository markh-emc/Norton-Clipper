<?php
defined('_JEXEC') or die;

 if ($this->countModules('productrelated')) : ?>
  <div id="productrelated" class="clearfix">
    <div class="internal-container">
    <?php if ($this->countModules('productrelated')) : ?>
      <div id="related">
        <jdoc:include type="modules" name="productrelated" style="xhtml" />
      </div>
    <?php endif;?>
  </div>
  </div>
<?php endif; ?>
