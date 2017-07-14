<?php

namespace App\Models;

use Kernel\Database;

class Model extends Database
{
    protected $table = null;

    protected $fillable = [];

    private $stmt = '';

    private $finded = null;

    private $persists = null;

    private function reset($resetPersists = false)
    {
        $this->stmt = '';
        if ($resetPersists) $this->persists = null;
    }

    private function getValues(array $params)
    {
        $arr = [];

        foreach ($this->fillable as $key) {
            array_push($arr, $params[$key]);
        }

        return $arr;
    }

    public function create(array $params)
    {
        $this->finded = null;
        $this->stmt = 'INSERT INTO ' . $this->table . '(';

        $this->stmt .= '`' . implode('`,`', $this->fillable) . '`';
        $this->stmt .= ') VALUES (';
        $this->stmt .= '\'' . implode('\',\'', $this->getValues($params)) . '\'';

        $this->stmt .= ');';

        $this->persists = $this->prepare($this->stmt);
        $this->persists->execute();

        $this->reset(true);

        return $this;
    }

    public function find($id)
    {
        $this->finded = $this->query('SELECT * FROM ' . $this->table . ' WHERE id=' . $id)->fetch_assoc();

        return $this;
    }

    public function all()
    {
        $this->stmt = 'SELECT * FROM ' . $this->table;
        $query = $this->query($this->stmt);

        $arr = [];
        while($row = $query->fetch_assoc()) {
            array_push($arr, $row);
        }

        $this->reset(true);

        return $arr;
    }

    public function get()
    {
        if ($this->finded) {
            return $this->finded;
        }

        return $this;
    }

    public function raw($query)
    {
        $this->stmt = $query;
        $results = $this->query($this->stmt);

        $arr = [];

        while($item = $results->fetch_assoc()) {
            array_push($arr, $item);
        }

        $this->reset(true);

        return $arr;
    }

    public function fill(array $params)
    {
        $this->stmt = 'UPDATE ' . $this->table . ' SET ';

        $arr = [];
        foreach($this->fillable as $item) {
            array_push($arr, $item . '=\'' . $params[$item] . '\'');
        }

        $this->stmt .= implode(',', $arr);
        $this->stmt .= 'WHERE id=' . $this->finded['id'];

        $this->persists = $this->prepare($this->stmt);
        $this->reset();

        return $this;
    }

    public function delete()
    {
        $this->stmt = 'DELETE FROM ' . $this->table . ' WHERE id=' . $this->finded['id'];

        $this->persists = $this->prepare($this->stmt);
        $this->persists->execute();

        $this->reset(true);

        return $this;
    }

    public function save()
    {
        $this->persists->execute();
        $this->reset(true);

        return $this;
    }
}