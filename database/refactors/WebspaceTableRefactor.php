<?php

use Illuminate\Database\Eloquent\Model;
use App\Webspace;
use App\Website;
use App\Platform;

class WebspaceTableRefactor {

  /**
   * Run the database refactoring
   *
   * @return void
   */
  public function run(){
    $count = 0;
    Webspace::whereNotNull('url')->active()
      // use & in count as pass-by reference
      ->get()->each( function ($webspace) use(&$count){
        /**
         *  transfer description and status to description_statusable for webspace
         *  it may appear that webspace and website will be duplicated, however, after this,
         *  both will have their own status and description
         * */
        $webspace->description_status()->create([
          "description" => $webspace->description,
          "mode" => $webspace->mode
        ]);
        // transfer to website entity
        $website = Website::firstOrCreate([
          'url' => $webspace->url,
          'platform_id' => $webspace->platform->id,
          'webspace_id' => $webspace->id
        ]);
        // create description statusable for website
        if ($website->id){
          $website->description_status()->create([
            "description" => $webspace->description,
            "mode" => $webspace->mode
          ]);
          $count++;
        }
        return $count;
      }
    );
    echo "There are {$count} data processed\n";
    echo "\nData refactoring for webspace is done\n";
  }
}