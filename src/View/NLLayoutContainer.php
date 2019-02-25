<?php

namespace GovtNZ\SilverStripe\NeoLayout\View;

use SilverStripe\ORM\FieldType\DBField;

/**
 * layout container component, which logically acts the top-level container for a layout.
 * When an NLView is constructed, this component is always at the top of the hierarchy,
 * It should not be removed, and new instances should not be added as childen.
 */
class NLLayoutContainer extends NLLayoutComponent
{

    public static function get_metadata()
    {
        return array(
            "name" => "Layout container",
            "description" => "Top-level container for a layout area",
            "imageURL" => null
        );
    }

    public function renderContent($context)
    {
        $content = "";
        $i = 0;

        if ($this->children) {
            foreach ($this->children as $child) {
                $temp = $this->extend('updateRenderContent', $i);

                if (!empty($temp)) {
                    if (is_string($temp[0])) {
                        $content .= $temp[0];
                    } else {
                        $content .= $temp[0]->RAW();
                    }
                }

                $renderedChild = $child->render($context);

                if (is_string($renderedChild)) {
                    $content .= $renderedChild;
                } else {
                    $content .= $renderedChild->RAW();
                }

                $i++;
            }
        }

        return DBField::create_field('HTMLText', $content);
    }
}
