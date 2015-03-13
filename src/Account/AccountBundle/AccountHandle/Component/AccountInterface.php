<?php

namespace Account\AccountBundle\AccountHandle\Component;

interface AccountInterface
{
    public function insertDatabase($object);
    public function deleteDatabase($object);
}