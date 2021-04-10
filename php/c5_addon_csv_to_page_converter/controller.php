<?php

namespace Concrete\Package\CsvToPageConverter;

use Concrete\Core\Backup\ContentImporter;
use Concrete\Core\Page\Single;
use Concrete\Core\Package\Package;

class Controller extends Package
{
    /**
     * @var string Package handle.
     */
    protected $pkgHandle = 'csv_to_page_converter';
    /**
     * @var string Required concrete5 version.
     */
    protected $appVersionRequired = '8.x';
    /**
     * @var string Package version.
     */
    protected $pkgVersion = '1.0';

    /**
     * @var array Array of location -> namespace autoloader entries for the package.
     */
    protected $pkgAutoloaderRegistries = [];

    protected $pkgAutoloaderMapCoreExtensions = true;

    /**
     * Returns the translated name of the package.
     *
     * @return string
     */
    public function getPackageName()
    {
        return t('Csv To Page Converter');
    }
    /**
     * Returns the translated package description.
     *
     * @return string
     */
    public function getPackageDescription()
    {
        return t('Use CsvImport');
    }
    /**
     * Installs the package info row and installs the database. Packages installing additional content should override this method, call the parent method,
     * and use the resulting package object for further installs.
     *
     * @return Package
     */
    public function install()
    {
        $pkg = parent::install();
        $ci = new ContentImporter();
        $ci->importContentFile($pkg->getPackagePath() . '/config/dashboard.xml');
    }
}