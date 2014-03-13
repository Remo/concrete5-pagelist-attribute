<?php
defined('C5_EXECUTE') or die('Access Denied.');
?>

<?php foreach ($pages as $page) { ?>
	<a href="<?php echo Loader::helper('navigation')->getLinkToCollection($page) ?>"><?php echo $page->getCollectionName() ?></a>
<?php } ?>