<?php
namespace System\Database\Traits;

trait HasSoftDelete{

    protected function deleteMethod($id = null){

        $object = $this;

        if($id){

            $this->resetQuery();
            $object = $this->findMethod($id);
        }

        if ($object){

            $this->resetQuery();
            $object->setSql("UPDATE ". $object->getTablename()
                . " SET " . $this->getAttributeName($this->deletedAt) . " = NOW() ");
            $object->setWhere("AND", $this->getAttributeName($object->primaryKey)." = ? ");
            $object->addValue($object->primaryKey, $object->{$object->primaryKey});
            return $object->executeQuery();
        }

        return null;
    }

    protected function allMethod(){

        $this->setSql("SELECT * FROM " . $this->getTableName());
        $this->setWhere("AND", $this->getAttributeName($this->deletedAt)." IS NULL ");
        $statement = $this->executeQuery();
        $data = $statement->fetchAll();

        if ($data){

            $this->arrayToObjects($data);
            return $this->collection;
        }

        return [];
    }

    protected function findMethod($id){

        $this->resetQuery();
        $this->setSql("SELECT * FROM " . $this->getTableName());
        $this->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ?");
        $this->addValue($this->primaryKey, $id);
        $this->setWhere("AND", $this->getAttributeName($this->deletedAt)." IS NULL ");
        $statement = $this->executeQuery();
        $data = $statement->fetch();
        $this->setAllowedMethods(['update', 'delete', 'save']);

        if ($data)
            return $this->arrayToAttributes($data);

        return null;
    }

    protected function getMethod($array = []){

        if ($this->sql == ''){

            if (empty($array))
                $fields = $this->getTableName() . ".*";

            else{

                foreach ($array as $key=>$field){
                    $array[$key] = $this->getAttributeName($field);
                }

                $field = implode(" , ", $array);
            }

            $this->setSql("SELECT $field FROM " . $this->getTableName());
        }

        $this->setWhere("AND", $this->getAttributeName($this->deletedAt)." IS NULL ");

        $statement = $this->executeQuery();
        $data = $statement->fetchAll();

        if ($data){

            $this->arrayToObjects($data);
            return $this->collection;
        }

        return [];
    }

    protected function paginateMethod($perPage){

        $this->setWhere("AND", $this->getAttributeName($this->deletedAt)." IS NULL ");

        $totalRows  = $this->getCount();
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $totalPages = ceil($totalRows/$perPage);
        $currentPage = min($currentPage, $totalPages);
        $currentPage = max($currentPage, 1);
        $currentRow = ($currentPage-1) * $perPage;
        $this->setLimit($currentRow, $perPage);

        if ($this->sql == '')
            $this->setSql("SELECT " . $this->getTableName() . ".* FROM " . $this->getTableName());

        $statement = $this->executeQuery();
        $data = $statement->fetchAll();

        if ($data){

            $this->arrayToObjects($data);
            return $this->collection;
        }

        return [];
    }


}