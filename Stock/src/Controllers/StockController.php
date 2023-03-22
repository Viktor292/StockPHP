<?php

namespace Controllers;

use FFI\Exception;

class StockController
{
    private $view;
    private $dao;

    public function __construct($dao, $view)
    {
        $this->view = $view;
        $this->dao = $dao;
    }

    public function main($userId)
    {
        $items = $this->dao->findAll($userId);
        $this->view->renderHtml('main.php', ['items' => $items]);
    }

    public function addItem($userId, $name, $typeNumber, $number, $price, $allprices, $resultprice)
    {
        try {
            $this->dao->add($userId, $name, $typeNumber, (int)$number, (int)$price, (int)$allprices, (int)$resultprice);
            $this->main($userId);
        } catch (Exception $e) {
            echo "<script>alert(\"Database error\");</script>";
        }     
    }

    public function updateItem($userId, $id, $name, $typeNumber, $number, $price, $allprices, $resultprice)
    {
        try {
            $this->dao->update($userId, (int)$id, $name, $typeNumber, (int)$number, (int)$price, (int)$allprices, (int)$resultprice);
            $this->main($userId);
        } catch (Exception $e) {
            echo "<script>alert(\"Database error\");</script>";
        } 
    }

    public function removeItem($userId, $id)
    {
        try {
            $this->dao->remove($userId, $id);
            $this->main($userId);
        } catch (Exception $e) {
            $this->main($userId);
            echo "<script>alert(\"Database error\");</script>";
        } 
    }

    public function removeAllItems($userId)
    {
        try {
            $this->dao->removeAll($userId);
            $this->main($userId);
        } catch (Exception $e) {
            $this->main($userId);
            echo "<script>alert(\"Database error\");</script>";
        } 
    }
}

?>