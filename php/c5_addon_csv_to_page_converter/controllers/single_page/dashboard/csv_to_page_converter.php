<?php

namespace Concrete\Package\CsvToPageConverter\Controller\SinglePage\Dashboard;

use Concrete\Core\Page\Controller\DashboardPageController;
use \Concrete\Core\Attribute\Type as AttributeType;
use Core;
use File;
use League\Csv\Reader;
use Loader;
use Concrete\Core\Http\Response;
use PageType;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Concrete\Core\Backup\ContentImporter;

class CsvToPageConverter extends DashboardPageController
{
    public function GetAttributeTypes() {
        $types = AttributeType::getAttributeTypeList();
        return $types;
    }

    public function GetPageTypes()
    {
        $siteType = false;
        if (!$siteType) {
            $siteType = $this->app->make('site/type')->getDefault();
        } else {
            $this->set('siteTypeID', $siteType->getSiteTypeID());
        }
        $pagetypes = PageType::getList(false, $siteType);

        if (is_array($pagetypes)) {
            $atr_pagetypes = [];
            $num = 0;
            foreach ($pagetypes as $pagetype):
                $atr_pagetypes[$num]['handle'] = $pagetype->ptHandle;
                $atr_pagetypes[$num]['name'] = $pagetype->ptName;
                $num++;
            endforeach;

            return $atr_pagetypes;
        } else {
            return $this->error->add(t('PageType NotFound...'));
        }
    }

    public function GetPackageTitle()
    {
        return Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper();
    }

    public function select_mapping()
    {
        if (!$this->token->validate('select_mapping')) {
            $this->error->add($this->token->getErrorMessage());
        }

        $fID = $this->request->request->get('csv');
        $name = $this->request->request->get('name');
        $path = $this->request->request->get('path');

        /** @var File|Version|\Concrete\Core\Entity\File\File $f */
        $f = File::getByID($fID);
        if (!is_object($f)) {
            $this->error->add(t('Invalid file.'));
        } else {
            $filename = $f->getFileName();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if($ext != 'csv') {
                $this->error->add(t('File Type Not Support.'));
            }
            ini_set("auto_detect_line_endings", true);
            $resource = $f->getFileResource();
            $reader = Reader::createFromStream($resource->readStream());
            $header = $reader->fetchOne();
            if (!is_array($header)) {
                $this->error->add(t('Invalid file.'));
            }
        }
        if (!$name) {
            $reader = Reader::createFromStream($resource->readStream());
            $header = $reader->fetchOne();
        }
        if (!$this->error->has()) {
            $this->set('f', $f);
            $this->set('name', $name);
            $this->set('path', $path);
            $this->set('header', $header);
        }
    }

    public function run_convert($fID = null)
    {
        if (!$this->token->validate('run_convert')) {
            $this->error->add($this->token->getErrorMessage());
        }
        /** @var File|Version|\Concrete\Core\Entity\File\File $f */
        $f = File::getByID($fID);
        if (!is_object($f)) {
            $this->error->add(t('Invalid file.'));
        } else {
            ini_set("auto_detect_line_endings", true);
            $resource = $f->getFileResource();
            $reader = Reader::createFromStream($resource->readStream());
            if (!is_object($reader)) {
                $this->error->add(t('Invalid file.'));
            }
        }
        if (!$this->error->has()) {
            $mapping = $this->request->request->get('mapping');
            $mapping_check = false;

            foreach ($mapping as $map) {
                if($map != '') {
                    $mapping_check = true;
                    break;
                }
            }

            $name = $this->request->request->get('name');
            $path = $this->request->request->get('path');
            $path = $path ? $path : '/export';

            $reader->setOffset(1);
            $results = $reader->fetch();

            if ($mapping_check) {
                $xml = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<concrete5-cif version="1.0">
<pages>
XML;
                $datas = '';
                $data_count = 0;
                foreach ($results as $result) {
                    $title = '';
                    if(is_array($result)) {
                        $i = 0;
                        foreach($result as $col) {
                            if($mapping[$i] == 'title') {
                                $title = $col;
                            }
                            $i++;
                        }
                    }
                    $path_data = $data_count == 0 ? $path : $path . '-' . $data_count;
                    $datas .= <<<DATAS
<page name="$title" path="$path_data" pagetype="$name">
    <attributes>
DATAS;
                    $i = 0;
                    foreach ($mapping as $index) {
                        $datas .= <<<DATAS
<attributekey handle="$index">
    <value>$result[$i]</value>
</attributekey>
DATAS;
                        $i++;
                    }
                    $datas .= <<<DATAS
    </attributes>
</page>
DATAS;
                    $data_count++;
                }
                $xml .= <<<XML
$datas
</pages>
</concrete5-cif>
XML;
                $xml = mb_convert_encoding($xml, 'UTF-8');
                $xml = simplexml_load_string($xml);
                $xml = $xml->asXML();
                $this->Process_Import($xml);
            } else {
                $this->error->add(t('Oops! Please allow one!'));
            }
        }
    }

    public function Process_Import($xml)
    {
        if (!$this->error->has()) {
            $ci = new ContentImporter();
            $ci->importContentString($xml);
            $this->set('message', t('Done.'));
        }
    }
}