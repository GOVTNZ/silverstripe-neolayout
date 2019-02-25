<?php

namespace GovtNZ\SilverStripe\NeoLayout\Model;

use GovtNZ\SilverStripe\NeoLayout\Forms\NLCMSLayoutEditorField;
use Page;

/**
 * NLEditableLayoutPage is a sample page type that includes an editable layout.
 * The intent is a very basic page where all the content is configured in the
 * NLView, and the page itself is the context for the view.
 */
class NLEditableLayoutPage extends Page
{
    private static $singular_name = "Editable Layout Page";

    private static $db = [
        "EditableLayout" => "Text"
    ];

    private static $table_name = 'NLEditableLayoutPage';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab(
            "Root.Layout",
            $layoutEditor = new NLCMSLayoutEditorField("EditableLayout", "Layout", $this)
        );

        $layoutEditor->setViewControllerURL($this->Link("DisplayView"));
        $layoutEditor->setContext($this);

        return $fields;
    }
}
