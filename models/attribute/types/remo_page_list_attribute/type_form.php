<?php
defined('C5_EXECUTE') or die('Access Denied.');

$selectedPageTypes = preg_split('[,]', $akSelectedPageTypes);
?>
<fieldset>
    <legend><?php echo t('Select Options') ?></legend>

    <div class="clearfix">
        <label><?php echo t("Page Type") ?></label>
        <div class="input">
            <ul class="inputs-list">
                <?php foreach ($collectionTypes as $key => $collectionType) { ?>
                    <li>
                        <label for="selectedPageTypes_<?php echo $key ?>">
                            <input <?php echo in_array($collectionType->getCollectionTypeID(), $selectedPageTypes) ? ' checked="checked" ' : '' ?> id="selectedPageTypes_<?php echo $key ?>" type="checkbox" name="selectedPageTypes[]" value="<?php echo $collectionType->getCollectionTypeID() ?>"/>
                            <?php echo $collectionType->getCollectionTypeName() ?>
                        </label>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php if (!empty($multilingualSections)): ?>
        <div class="clearfix">
            <label><?php echo t('Language'); ?></label>
            <div class="input">
                <?= $form->select('displayMultilingualSection', $multilingualSections, 0); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="clearfix">
        <label><?php echo t("Display Drop-Down") ?></label>
        <div class="input">
            <ul class="inputs-list">
                <li>
                    <label>
                        <?php echo $form->checkbox('displayDropDown', 1, $akDisplayDropDown) ?> 
                        <span><?= t('Always display drop down in search form.') ?>
                        </span>
                    </label>
                </li>
            </ul>
        </div>
    </div>        
</fieldset>
