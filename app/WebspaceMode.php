<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebspaceMode extends ReadOnlyBase
{
    //
    protected $webspace_mode = ['Active','Disabled','Inactive','Deleted'];
}
