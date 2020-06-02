<?php
namespace Dunkers;

class App
{
    public function __construct()
    {
        new \Dunkers\Theme\Enqueue();
        new \Dunkers\Theme\Navigation();
        new \Dunkers\Theme\Filters();
    }
}
