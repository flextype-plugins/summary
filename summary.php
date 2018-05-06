<?php namespace Flextype;

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

use Flextype\Component\Event\Event;

//
// Add listner for onPageContentAfter event
//
Event::addListener('onPageContentAfter', function () {
    if (($pos = strpos(Pages::$page['content'], "<!--more-->")) === false) {

    } else {
        $page_content = explode("<!--more-->", Pages::$page['content']);
        Pages::$page['summary'] = Event::dispatch('content', ['content' => Pages::parseContent($page_content[0])], true);
        Pages::$page['content'] = Event::dispatch('content', ['content' => Pages::parseContent($page_content[0].$page_content[1])], true);
    }
});
