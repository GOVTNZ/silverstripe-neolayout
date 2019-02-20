<?php

namespace GovtNZ\SilverStripe\NeoLayout\ORM;

use SilverStripe\ORM\FieldType\DBVarchar;
use SilverStripe\Core\ClassInfo;
use SilverStripe\ORM\DataObject;

/**
 * Used to represent references to ORM objects. When setValue is called, the object reference is looked up, and returned
 * as the value.
 */
class NLObjectReference extends DBVarchar
{
    public function setValue($value, $record = null, $markChanged = true)
    {
        $parts = explode(":", $value);

        if (!is_array($parts) || count($parts) != 2 || !ClassInfo::exists($parts[0]) || !is_numeric($parts[1])) {
            return;
        }

        $this->value = DataObject::get_by_id($parts[0], $parts[1]);
    }
}
