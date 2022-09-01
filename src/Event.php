<?php

namespace App;

use Symfony\Component\Validator\Constraints\NotBlank;

class Event
{
    #[NotBlank()]
    public $name;

    #[NotBlank()]
    public $description;
}
