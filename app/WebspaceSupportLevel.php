<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebspaceSupportLevel extends ReadOnlyBase
{
    protected $webspace_support_level = ['Full','Co-Managed','Technical','Hosting'];
}
