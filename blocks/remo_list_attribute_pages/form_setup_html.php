<?php
defined('C5_EXECUTE') or die('Access Denied.');
$fh = Loader::helper('form');
?>

<fieldset>
        <legend style="margin-bottom: 0px"><?php echo t('Attribute') ?></legend>

        <div class="control-group">
                <label class="control-label"><?php echo t('Attribute to display') ?></label>
                <div class="controls">
			<?php
			foreach ($availableAttributes as $attribute) {
				?>
				<label>
					<?php echo $fh->radio('akHandle', $attribute->getAttributeKeyHandle(), $akHandle) ?>
					<?php echo $attribute->getAttributeKeyName() ?>
				</label>

				<?php
			}
			?>
                </div>
        </div>
</fieldset>
