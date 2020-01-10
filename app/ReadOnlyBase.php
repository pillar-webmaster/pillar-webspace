<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyBase
{
    protected $webspace_status = [];
    protected $webspace_support_level = [];
    protected $webspace_mode = [];

    public function all ( $element ){
        $element = "webspace_". $element;
        return $this->$element;
    }

    public function get_webspace_mode( $id ){
        return $this->webspace_mode[$id];
    }

    public function get_webspace_support_level( $id ){
        return $this->webspace_support_level[$id];
    }

}
