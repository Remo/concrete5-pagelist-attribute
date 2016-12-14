<?php
defined('C5_EXECUTE') or die('Access Denied.');

$pl = new PageList();

// filter by selected page types
$selectedPageTypes = preg_split('[,]', $akSelectedPageTypes, PREG_SPLIT_NO_EMPTY);
if (is_array($selectedPageTypes) && !empty($selectedPageTypes)) {
    $selectedPageTypesString = join(',', $selectedPageTypes);
    $pl->filter(false, "pt.ctID in ({$selectedPageTypesString})");
}
if (!empty($akDisplayMultilingualSection)) {
    $ms = MultilingualSection::getByID($akDisplayMultilingualSection);
    if (is_object($ms)) {
        $pl->addToQuery(' left join MultilingualPageRelations mpr on(p1.cID = mpr.cID)');
        $pl->filter('mpr.mpLocale', $ms->getLocale());
    }
}

$pages = $pl->get(0);
?>

<?php if ($akDisplayDropDown) { ?>
    <select name="<?php echo $this->field('atPageID') ?>[]" >
        <option value=""><?php echo t('All') ?></option>
        <?php foreach ($pages as $page) { ?>
        <option value="<?php echo $page->getCollectionID() ?>" <?php if (in_array($page->getCollectionID(), $selectedPages)) { ?> selected <?php } ?>><?php echo $page->getCollectionName() ?></option>
        <?php } ?>
    </select>
<?php } else { ?>
    <?php foreach ($pages as $page) { ?>
        <label for="page_<?php echo $page->getCollectionID() ?>">
            <input <?php echo in_array($page->getCollectionID(), $selectedPages) ? ' checked="checked" ' : '' ?> style="display: inline;" id="page_<?php echo $page->getCollectionID() ?>" type="checkbox" name="<?= $this->field('atPageID') ?>[]" value="<?php echo $page->getCollectionID() ?>"/>
            <?php echo $page->getCollectionName() ?>
        </label>
    <?php } ?>
<?php } ?>
