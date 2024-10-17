<?php

class controllerOrders{
    
    public function listOrderByclient ($id_user) {
        try {
            $modelOrders = new modelOrders();
            return $modelOrders->listOrderByClient($id_user);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createOrder($data){
        try {
            $modelOrders = new modelOrders();
            return $modelOrders->createOrder();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateOrder($id, $data){
        try {
            $modelOrders = new modelOrders();
            return $modelOrders->updateOrder($id, $data);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function detailsOrderById ($id){
        try {
            $modelOrders = new modelOrders();
            return $modelOrders->detailsOrderById ($id);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function listAllOrders () {
        try {
            $modelOrders = new modelOrders();
            return $modelOrders->listAllOrders ();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function listOrderByStatus ($id_status){
        try {
            $modelOrders = new modelOrders();
            return $modelOrders->listOrderByStatus ($id_status);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createCart ($data){
        try {
            $modelOrders = new modelOrders();
            return $modelOrders->createCart ($data);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function InsertItenCart ($data){
        try {
            $modelOrders = new modelOrders();
            return $modelOrders->InsertItenCart ($data);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteCart ($id_cart){
        try {
            $modelOrders = new modelOrders();
            return $modelOrders->deleteCart ($id_cart);
        } catch (PDOException $e) {
            return false;
        }
    }




}


?>