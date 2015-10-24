<?php

use Foolz\FoolFrame\Model\Autoloader;
use Foolz\FoolFrame\Model\Context;
use Foolz\Plugin\Event;

class HHVM_Sage
{
    public function run()
    {
        Event::forge('Foolz\Plugin\Plugin::execute#foolz/foolfuuka-plugin-visualsage')
            ->setCall(function($result) {

                /* @var Context $context */
                $context = $result->getParam('context');
                /** @var Autoloader $autoloader */
                $autoloader = $context->getService('autoloader');

                $autoloader->addClass('Foolz\FoolFuuka\Plugins\VisualSage\Model\Sage', __DIR__.'/classes/model/sage.php');

                Event::forge('Foolz\FoolFuuka\Model\Comment::getNameProcessed#var.processedName')
                    ->setCall('Foolz\FoolFuuka\Plugins\VisualSage\Model\Sage::process')
                    ->setPriority(5);

                Event::forge('Foolz\FoolFuuka\Model\RadixCollection::structure#var.structure')
                    ->setCall(function($result) {
                        $structure = $result->getParam('structure');
                        $structure['plugin_sage_enable'] = [
                            'database' => true,
                            'boards_preferences' => true,
                            'type' => 'checkbox',
                            'help' => _i('Enable visual feedback for sage')
                        ];
                        $structure['plugin_sage_appendtext'] = [
                            'database' => true,
                            'boards_preferences' => true,
                            'type' => 'input',
                            'class' => 'span3',
                            'label' => 'HTML to append to saged posts names',
                            'help' => _i(''),
                            'default_value' => ' <span style="color: red">[sage]</span>'
                        ];
                        $result->setParam('structure', $structure)->set($structure);
                    })->setPriority(4);
            });
    }
}
(new HHVM_Sage())->run();
