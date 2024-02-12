<?php

namespace Ali\TalabashAssignment\Form;

class Form
{
    public function __construct()
    {
        // Here we can set any default values or check payment available methods.
    }

    public function display(): void
    {
        readfile('form.html', true);
    }
}