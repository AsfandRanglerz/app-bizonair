<?php

namespace App\Http\Resources\Concerns;

trait Pagination
{
    private $to;
    private $from;
    private $total;
    private $perPage;
    private $currentPage;
    private $previousPage;
    private $nextPage;
    private $lastPage;
    private $nextPageUrl;
    private $hasMorePages;


    public function paginate()
    {
        $this->loadAllProperties();

        $this->unsetResource();
        return [
            'data'       => $this->collection,
            'pagination' => $this->getPagination()
        ];
    }

    private function getPagination()
    {
        return [
            'to'             => $this->to,
            'from'           => $this->from,
            'total'          => $this->total,
            'per_page'       => $this->perPage,
            'current_page'   => $this->currentPage,
            'previous_page'  => $this->previousPage,
            'next_page'      => $this->nextPage,
            'last_page'      => $this->lastPage,
            'next_page_url'  => $this->nextPageUrl,
            'has_more_pages' => $this->hasMorePages,

        ];
    }

    private function loadAllProperties(): void
    {
        $previousPage = $this->currentPage() - 1;

        $this->to           = $this->to();
        $this->from         = $this->from();
        $this->total        = $this->total();
        $this->perPage      = $this->perPage();
        $this->currentPage  = $this->currentPage();
        $this->previousPage = $previousPage == 0 ? $this->currentPage() : $previousPage;
        $this->nextPage     = $this->hasMorePages() ? $this->currentPage() + 1 : $this->currentPage();
        $this->lastPage     = $this->lastPage();
        $this->nextPageUrl  = $this->nextPageUrl();
        $this->hasMorePages = $this->hasMorePages();


        unset($previousPage);
    }

    private function unsetResource(): void
    {
        unset($this->resource);
    }


    private function from()
    {
        return $this->perPage() * ($this->currentPage() - 1) + 1;
    }

    private function to()
    {
        $highBound = $this->from() + $this->perPage();
        if ($this->total() < $highBound) {
            $highBound = $this->total();
        }

        return $highBound;
    }
}
