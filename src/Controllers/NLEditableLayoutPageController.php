<?php

namespace GovtNZ\SilverStripe\NeoLayout\Controllers;

use PageController;

class NLEditableLayoutPageController extends PageController
{
    private static $allowed_actions = [
        "DisplayView"
    ];

    /**
     * Template function to render the view.
     */
    public function DisplayView()
    {
        return new NLView($this, "DisplayView", $this->data()->EditableLayout, $this);
    }
}
