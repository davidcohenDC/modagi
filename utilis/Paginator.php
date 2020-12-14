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

    public function __construct($table)
    {
        $this->table = $table;
        $this->page = 1;
        $this->startPage= ($this->page-1) * $this->elementForPage;
        $this->totalPages = 1;
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

    public function setNewFilter($query) {
        $this->query = $query;
        $this->resultQuery = $this->table->Select($query);
        //$this->refresh();
    }

    public function setNextUrlPage() {
        $this->page = $this->retrivePage()+1;
        if($_SERVER['REQUEST_URI'] != "/") {
            return change_url_parameter($_SERVER['REQUEST_URI'],"pag",$this->page);
        } else {
            return "?pag=".$this->page;
        }
        
    }

    public function setPrevUrlPage() {
        $this->page = $this->retrivePage()-1;
        if($_SERVER['REQUEST_URI'] != "/") {
            return change_url_parameter($_SERVER['REQUEST_URI'],"pag",$this->page);
        } else {
            return "?pag=".$this->page;
        }
 
    }

    public function getLastUrlPage() {
        if($_SERVER['REQUEST_URI'] != "/") {
            return change_url_parameter($_SERVER['REQUEST_URI'],"pag",$this->totalPages);
        } else {
            return "?pag=".$this->totalPages;
        }
        
    }

    public function getFirstUrlPage() {
        $this->page = 1;
        if($_SERVER['REQUEST_URI'] != "/") {
            return change_url_parameter($_SERVER['REQUEST_URI'],"pag",$this->page);
        } else {
            return "?pag=".$this->page;
        }
    }

    public function paging() {

        $this->retrivePage();
        $this->refresh();

        if($this->startPage > 1) {
            $this->query = $this->query. " LIMIT ". $this->elementForPage. " OFFSET ". $this->startPage;
            $this->resultQuery = $this->table->Select($this->query);
            return $this->resultQuery;
        } else {
            $this->query = $this->query. " LIMIT ". $this->elementForPage;
            $this->resultQuery = $this->table->Select($this->query);
            return $this->resultQuery;
        }

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

    public function setElementForPage($elemForPage) {
        $this->elementForPage = $elemForPage;
    }

    public function getPage() {
        return $this->page;
    }

}
?>