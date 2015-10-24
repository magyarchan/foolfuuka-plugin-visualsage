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
    if ($data->comment->email === 'sage' && $data->comment->op === '0')
    {
      $result->setParam('name', $result->getParam('name').$data->radix->getValue('plugin_sage_appendtext'));
      $result->set($result->getParam('name'));
    }
    return null;
  }
}
