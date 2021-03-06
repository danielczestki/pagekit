<?php

namespace Pagekit\Site\Event;

use Pagekit\Application as App;
use Pagekit\Event\EventSubscriberInterface;
use Pagekit\Site\Entity\Node;

class NodesListener implements EventSubscriberInterface
{
    /**
     * Registers node routes
     */
    public function onRequest()
    {
        $site = App::module('system/site');

        foreach (Node::where(['status = ?'], [1])->get() as $node) {

            if (!$type = $site->getType($node->getType())) {
                continue;
            }

            $type['path']     = $node->getPath();
            $type['defaults'] = array_merge(isset($type['defaults']) ? $type['defaults'] : [], $node->get('defaults', []), ['_node' => $node->getId()]);

            $route = null;
            if (isset($type['alias'])) {
                $route = App::routes()->alias($type['path'], $node->getLink($type['alias']), $type['defaults']);
            } elseif (isset($type['controller'])) {
                $route = App::routes()->add($type);
            }

            if ($route && $node->getId() == $site->config('frontpage')) {
                $site->setFrontpage($route->getName());
            }

        }

        if ($frontpage = $site->getFrontpage()) {
            App::routes()->alias('/', $frontpage);
        } else {
            App::routes()->get('/', function () {
                return __('No Frontpage assigned.');
            });
        }
    }

    /**
     * Adds protected node types.
     */
    public function onEnable($event, $module)
    {
        foreach ((array) $module->get('nodes') as $type => $route) {
            if (isset($route['protected']) and $route['protected'] and !Node::where(['type = ?'], [$type])->first()) {

                $node = new Node();
                $node->setTitle($route['label']);
                $node->setSlug($this->slugify($route['label']));
                $node->setType($type);
                $node->setStatus(1);

                $node->save();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe()
    {
        return [
            'request' => ['onRequest', 110],
            'enable' => 'onEnable'
        ];
    }

    protected function slugify($slug)
    {
        $slug = preg_replace('/\xE3\x80\x80/', ' ', $slug);
        $slug = str_replace('-', ' ', $slug);
        $slug = preg_replace('#[:\#\*"@+=;!><&\.%()\]\/\'\\\\|\[]#', "\x20", $slug);
        $slug = str_replace('?', '', $slug);
        $slug = trim(mb_strtolower($slug, 'UTF-8'));
        $slug = preg_replace('#\x20+#', '-', $slug);

        return $slug;
    }
}
