<?php

namespace GovtNZ\SilverStripe\NeoLayout\View;

use SilverStripe\ORM\FieldType\DBField;

/**
 * Box layout component, which implements a simple horizontal box for laying
 * out its children.
 */
class NLHorizontalBoxLayout extends NLLayoutComponent
{

    public static function get_metadata()
    {
        return array(
            "name" => "Horizontal Box layout",
            "description" => "Lets you group other items, and arrange them horizontally",
            "imageURL" => null
        );
    }

    public function renderContent($context)
    {
        $content = "";
        if ($this->children) {
            foreach ($this->children as $child) {
                $renderedChild = $child->render($context);

                if (is_string($renderedChild)) {
                    $content .= $renderedChild;
                } else {
                    $content .= $renderedChild->RAW();
                }
            }
        }

        return DBField::create_field('HTMLText', $content);
    }
}
