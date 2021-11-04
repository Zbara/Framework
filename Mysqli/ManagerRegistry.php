<?php

namespace Zbara\Framework\Mysqli;

interface ManagerRegistry
{
    public function query($query, $type);
    public function escape($string);
    public function real_escape_string($string);
    public function closeDatabase();
}