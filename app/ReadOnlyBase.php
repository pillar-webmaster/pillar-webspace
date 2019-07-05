<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyBase
{
    protected $webspace_status = [];
    protected $webspace_support_level = [];

    public function all ( $element ){
        $element = "webspace_". $element;
        return $this->$element;
    }

    public function get_webspace_status( $id ){
        return $this->webpace_status_array[$id];
    }
}
