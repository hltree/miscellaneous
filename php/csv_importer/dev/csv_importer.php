<?php

namespace CsvImporter;

class CsvImporter
{
    public
        $files = [];

    public function __construct()
    {
        $this->get_files();
        $this->read_files();
    }

    public function get_files()
    {
        $files = [];
        foreach (glob('./csv/*.csv') as $file) {
            $files[] = $file;
        }

        return $this->files = $files;
    }

    public function read_files()
    {
        foreach ($this->files as $file) {
            $read = new \SplFileObject($file);
            echo $read.PHP_EOL;
        }
    }
}

$csv_importer = new CsvImporter();