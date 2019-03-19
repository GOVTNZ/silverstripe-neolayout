<?php

namespace GovtNZ\SilverStripe\NeoLayout\ORM;

use SilverStripe\ORM\FieldType\DBVarchar;
use SilverStripe\Core\ClassInfo;
use SilverStripe\ORM\DataObject;
use SilverStripe\Core\Injector\Injector;
use Psr\Log\LoggerInterface;

/**
 * Used to represent references to ORM objects. When setValue is called, the object reference is looked up, and returned
 * as the value.
 */
class NLObjectReference extends DBVarchar
{
    private static $class_migration_mapping = [];

    public function setValue($value, $record = null, $markChanged = true)
    {
        $parts = explode(":", $value);

        if (!is_array($parts) || count($parts) != 2 || !is_numeric($parts[1])) {
            return;
        }

        switch ($parts[0]) {
            case 'SiteTree':
                $parts[0] = 'SilverStripe\CMS\Model\SiteTree';
                break;
        }

        if (!ClassInfo::exists($parts[0])) {
            // try to map
            $mapping = $this->config()->get('class_migration_mapping');

            foreach ($mapping as $k => $v) {
                if (strtolower(trim($parts[0])) == strtolower(trim($k))) {
                    $parts[0] = $v;

                    break;
                }
            }

            if (!ClassInfo::exists($parts[0])) {
                Injector::inst()->get(LoggerInterface::class)->warning(
                    $parts[0] .' is not a valid class for NLObjectReference'
                );
            }
        }

        $this->value = DataObject::get_by_id($parts[0], $parts[1]);
    }
}
