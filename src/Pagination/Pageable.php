<?php

namespace App\Pagination;

use Doctrine\ORM\Query;

trait Pageable
{
    /**
     * @param Query $query
     * @param int $page
     * @param int $limit
     * @return Pager
     */
    public function paginate(Query $query, $page, $limit)
    {
        return new Pager($query, $page, $limit);
    }
}
