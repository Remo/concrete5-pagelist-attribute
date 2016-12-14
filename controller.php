<?php

defined('C5_EXECUTE') or die('Access Denied.');

class RemoPageListAttributePackage extends Package {

	protected $pkgHandle = 'remo_page_list_attribute';
	protected $appVersionRequired = '5.6.2.1';
	protected $pkgVersion = '0.0.21';

	public function getPackageDescription() {
		return t('Adds an attribute where you can select pages.');
	}

	public function getPackageName() {
		return t('Pagelist Attribute');
	}

	public function install() {
		$pkg = parent::install();

		$ci = new ContentImporter();
		$ci->importContentFile($pkg->getPackagePath() . '/install.xml');
	}

	public function upgrade() {
                // make sure the new column exists
                $db = Loader::db();
                $sql = 'SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = "'.DB_DATABASE.'" AND TABLE_NAME = "atRemoPagelistAttributeSettings" AND COLUMN_NAME = "displayMultilingualSection"';
                $row = $db->GetAll($sql);
                if (empty($row)) {
                    $sql = 'ALTER TABLE atRemoPagelistAttributeSettings ADD displayMultilingualSection INT(255) after displayDropDown';
                    $db->Execute($sql);
                    Log::addEntry(t('Table atRemoPagelistAttributeSettings expanded with column displayMultilingualSection'), 'packages');
                }

		$pkg = Package::getByHandle($this->pkgHandle);
		$ci = new ContentImporter();
		try {
			$ci->importContentFile($pkg->getPackagePath() . '/install.xml');
		} catch (Exception $ex) {
			
		}
                
		parent::upgrade();
	}

}
