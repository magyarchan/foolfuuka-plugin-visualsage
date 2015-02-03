<?php

namespace Foolz\FoolFuuka\Plugins\VisualSage\Model;

use Foolz\FoolFuuka\Model\Comment;

class Sage
{ 
  public static function process($result)
  {
    $data = $result->getObject();
    if (!$data->radix->getValue('plugin_sage_enable'))
    {
      return null;
    }
    $str2append = ' <span style="color: red">[bölcs]</span>';
    if ($data->comment->email === 'sage')
    {
      $result->setParam('name', $result->getParam('name').$str2append);
      $result->set($result->getParam('name'));
    }
    return null;
  }
}
