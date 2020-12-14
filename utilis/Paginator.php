<?php

class Paginator{
    private $page;
    private $elementForPage;
    private $startPage;
    private $records;
    private $totalPages;
    private $table;
    private $query;
    private $resultQuery;

    public function __construct($table,$query, $elementForPage)
    {
        $this->table = $table;
        $this->query = $query;
        $this->page = 1;
        $this->elementForPage= $elementForPage;
        $this->startPage= ($this->page-1) * $this->elementForPage;
        $this->totalPages = 1;
        $this->resultQuery = $table->Select($query);
        $this->records = count($this->resultQuery);
    }


    private function retrivePage() {
        
        if(isset($_GET["pag"])) {
            return $this->page = $_GET["pag"];
        } else {
            return $this->page = 1;
        }
    }

    private function refresh() {
        $this->startPage = ($this->page-1) * $this->elementForPage;
        $this->records = count($this->resultQuery);
        $this->totalPages = ceil($this->records / $this->elementForPage);
    }


    public function getPage() {
        return $this->page;
    }

    public function setNewFilter($query) {
        $this->query = $query;
    }

    public function getQuery() {
        return $this->query;
    }

    public function getStartPage() {
        return $this->startPage;
    }

    public function getTotalPages() {
        return $this->totalPages;
    }

    public function getRecords() {
        return $this->records;
    }

    public function paging() {

        $this->retrivePage();
        $this->refresh();

        if($this->startPage > 1) {
            $this->query = $this->query. " LIMIT ". $this->records. " OFFSET ". $this->startPage;
            $this->resultQuery = $this->table->Select($this->query);
            return $this->resultQuery;
        } else {
            $this->query = $this->query. " LIMIT ". $this->elementForPage;
            $this->resultQuery = $this->table->Select($this->query);
            return $this->resultQuery;
        }

    }

}
?>