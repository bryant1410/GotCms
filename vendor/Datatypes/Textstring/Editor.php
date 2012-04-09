<?php
namespace Datatypes\Textstring;

use Es\Datatype\AbstractDatatype\AbstractEditor,
    Zend\Form\Element;

class Editor extends AbstractEditor
{
    public function save()
    {
        $value = $this->getRequest()->post()->get($this->getName());
        $this->setValue($value);
    }

    public function load()
    {
        $parameters = $this->getConfiguration();
        $property = $this->getProperty();
        $textstring = new Element\Text($this->getName());
        $textstring->setLabel($property->getName());
        $textstring->setValue($this->getValue());
        if(!empty($parameters['length']))
        {
            $textstring->setAttrib('maxlength', $parameters['length']);
        }

        return $textstring;
    }
}
