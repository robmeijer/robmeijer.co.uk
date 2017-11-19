<?php

namespace App\Pagination;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Pager extends Paginator
{
    /**
     * @var PagerData
     */
    public $pager;

    /**
     * @param Query $query
     * @param int $page
     * @param int $limit
     */
    public function __construct(Query $query, $page = 1, $limit = 10)
    {
        parent::__construct($query);

        $this->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        $this->pager = new PagerData($this->count(), $limit, $page);

        if ($this->outOfBounds($page)) {
            throw new NotFoundHttpException("Page '{$page}' not found. There are only '{$this->pager->getMaxPages()}' pages.");
        }
    }

    private function outOfBounds(int $page): bool
    {
        return $page > $this->pager->getMaxPages() && $this->pager->getMaxPages() !== 0;
    }
}
