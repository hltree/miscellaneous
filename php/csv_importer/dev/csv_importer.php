<?php

namespace CsvImporter;

class CsvImporter
{
    public
        $file,
        $file_path;

    public function __construct($file)
    {
        $this->file = $file;
        $this->get_file($this->file);
    }

    public function get_file($file)
    {
        return $this->file_path = realpath($file);
    }
}