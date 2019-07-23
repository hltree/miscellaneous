<?php
namespace Classes\Controller;

use Psr\Container\ContainerInterface;
use Slim\Views\PhpRenderer;

abstract class Controller {
    /** var \PDO */
    protected $db;
    /** var PhpRender */
    protected $renderer;

    public function __construct(ContainerInterface $container)
    {
        $this->db = $container['db'];
        $this->renderer = $container['renderer'];
    }
}