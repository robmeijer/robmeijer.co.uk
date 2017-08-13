<?php

namespace App\Pagination;

class PagerData
{
    /**
     * @var int
     */
    protected $count;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    protected $page;

    /**
     * @param int $count
     * @param int $limit
     * @param int $page
     */
    public function __construct($count, $limit, $page)
    {
        $this->count = $count;
        $this->limit = $limit;
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getMaxPages()
    {
        return (int) ceil($this->count / $this->limit);
    }

    /**
     * @return int
     */
    public function getFrom()
    {
        return $this->limit * ($this->page - 1) + 1;
    }

    /**
     * @return int
     */
    public function getTo()
    {
        $to = $this->limit * ($this->page - 1) + $this->limit;

        return $to < $this->count ? $to : $this->count;
    }
}
