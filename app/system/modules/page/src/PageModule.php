<?php

namespace Pagekit\Page;

use Pagekit\Application as App;
use Pagekit\Module\Module;
use Pagekit\Page\Entity\Page;
use Pagekit\Site\Entity\Node;

class PageModule extends Module
{
    // TODO: move to SiteListener

    /**
     * Find page entity by node.
     *
     * @param  Node $node
     * @return Page
     */
    public function getPage(Node $node)
    {
        $variables = $node->get('variables', []);

        if (!isset($variables['id']) or !$page = Page::find($variables['id'])) {
            $page = new Page();
        }

        return $page;
    }
}
