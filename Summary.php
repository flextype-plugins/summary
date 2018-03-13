<?php
namespace Rawilum;

class Summary
{
    /**
     * @var Rawilum
     */
    protected $rawilum;

    /**
     * Constructor
     *
     * @param Rawilum $rawilum
     */
    public function __construct(Rawilum $c)
    {
        $this->rawilum = $c;
        $this->rawilum['events']->addListener('onPageContentAfter', array($this, 'parse'));
    }

    /**
     * Parse content to find <!--more--> for summary
     */
    public function parse()
    {
        if (($pos = strpos($this->rawilum['pages']->page['content'], "<!--more-->")) === false) {

        } else {
            $page_content = explode("<!--more-->", $this->rawilum['pages']->page['content']);
            $this->rawilum['pages']->page['summary'] = $this->rawilum['filters']->dispatch('content', $this->rawilum['pages']->parseContent($page_content[0]));
            $this->rawilum['pages']->page['content'] = $this->rawilum['filters']->dispatch('content', $this->rawilum['pages']->parseContent($page_content[0].$page_content[1]));
        }
    }
}

new Summary($rawilum);
