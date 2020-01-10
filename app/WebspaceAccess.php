<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebspaceAccess extends ReadOnlyBase
{
    //
    protected $webspace_access = ['Web','SFTP','SSH','FTP'];
}
