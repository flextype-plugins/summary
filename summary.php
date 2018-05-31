<?php

/**
 *
 * Summary Plugin for Flextype
 *
 * @author Romanenko Sergey / Awilum <awilum@yandex.ru>
 * @link http://flextype.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Flextype;

use Flextype\Component\Event\Event;

//
// Add listner for onPageContentAfter event
//
Event::addListener('onCurrentPageBeforeDisplayed', function () {
    $page = Content::getCurrentPage();

    if (($pos = strpos($page['content'], "<!--more-->")) === false) {

    } else {
        $page_content = explode("<!--more-->", $page['content']);
        Content::updateCurrentPage('summary', Content::processContent($page_content[0]));
        Content::updateCurrentPage('content', Content::processContent($page_content[0].$page_content[1]));
    }
});
