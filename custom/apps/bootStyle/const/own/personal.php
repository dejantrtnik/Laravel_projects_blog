<?php
namespace own;


class Site
{
  public function __construct($personal)
  {
    $this->title  = $personal['title'];
    $this->demo   = $personal['demo'];
    $this->demo2  = $personal['demo2'];
    $this->header = $personal['header'];
    $this->footer = $personal['footer'];
  }
  
  function personal($siteIndex){
    switch ($siteIndex) {
      case 'title':$this->title;break;
      case 'demo':$this->demo;break;
      case 'demo2':$this->demo2;break;
      case 'header':$this->header;break;
      case 'footer':$this->footer;break;

      default:break;
    }

  /*  PHP 8 (echo match())
  function personal($siteIndex){
    echo match ($siteIndex){
      'title'  => $this->title,
      'demo'   => $this->demo,
      'demo2'  => $this->demo2,
      'header' => $this->header,
      'footer' => $this->footer,
    };
  */  

  }
  //const TITLE = $this->title;
}


?>
