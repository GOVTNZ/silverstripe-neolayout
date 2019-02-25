<?php

namespace GovtNZ\SilverStripe\NeoLayout\View;

use SilverStripe\View\ViewableData;

class NLViewAddableItem extends ViewableData
{
    /**
     * @param $name
     * @param $description
     * @param $imageURL
     * @param $type         type of thing. e.g. NLLinkComponent, File, Image
     * @param $objectClass
     * @param $objectID
     * @param $ID           ID of object if it is an object (not valid for components)
     */
    function __construct($name, $description, $imageURL, $type, $objectClass = null, $objectID = null, $objectBinding = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->imageURL = $imageURL;
        $this->type = $type;
        $this->objectClass = $objectClass;
        $this->objectID = $objectID;
        $this->objectBinding = $objectBinding;
    }
}
