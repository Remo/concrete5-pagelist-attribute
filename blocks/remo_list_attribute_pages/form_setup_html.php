<?php
defined('C5_EXECUTE') or die('Access Denied.');
$fh = Loader::helper('form');

$c = Page::getCurrentPage();
?>

<fieldset>
	<legend style="margin-bottom: 0px"><?php echo t('Attribute') ?></legend>

	<div class="control-group">
		<label class="control-label"><?php echo t('Attribute to display') ?></label>
		<div class="controls">
			<?php
			$availableAttributes = $c->getSetCollectionAttributes();
			foreach ($availableAttributes as $attribute) {
				if ($attribute->getAttributeType()->getAttributeTypeHandle() != 'remo_page_list_attribute') {
					continue;
				}
				?>
				<label>
					<input type="radio" name="akHandle" value="<?php echo $attribute->getAttributeKeyHandle() ?>"/>
					<?php echo $attribute->getAttributeKeyName() ?>
				</label>

				<?php
			}
			?>
		</div>
	</div>
</fieldset>
