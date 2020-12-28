<?php

namespace mvc\Core;

use mvc\Config\Database;
use PDO;

class ResourceModel implements ResourceModelInterface
{
    protected $table;
    protected $id;
    protected $model;

    public function _init($table, $id, $model)
    {
        // TODO: Implement _init() method.
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function save($model)
    {
        // TODO: Implement save() method.
        //Chuyển đổi tượng model thành mảng
        $arrModel = $model->getProperties();
        //Nếu chưa có bất kỳ mảng nào
        if ($model->getId() == null) {
            //loại bỏ 2 mảng id và updated_at
            unset($arrModel["id"]);
            unset($arrModel["updated_at"]);
            //lấy về tất cả key của mảng lúc này khi đã loại trừ mảng id và updated_at
            $arrKey = array_keys($arrModel);
            //đổi tất cả key đã lấy ở trên thành chuỗi, phân cách các key bằng ","
            $strKey = implode(",", $arrKey);
            //đổi tất cả key đã lấy ở trên thành chuỗi, phân cách các key bằng ", :"
            $arrKeyValue = ":" . implode(", :", $arrKey);
            //lệnh sql dùng chuỗi đã chuyển đổi
            $sql = "INSERT INTO $this->table ( {$strKey} ) VALUES ( {$arrKeyValue} )";
        } else {
            //loại bỏ mảng created_at
            unset($arrModel["created_at"]);
            //lấy về các key của mảng lúc này, đồng thời loại trừ mảng id
            $arrKey = array_keys($arrModel);
            unset($arrKey["id"]);

            $str = "";
            //vòng lặp lấy ra value dưới dạng chuỗi:"value= :value, value= :value,..."
            foreach ($arrKey as $key => $value) {
                $str .= $value . "= :" . $value . ",";
            }
            //cắt đi phần tử cuối cùng của chuỗi
            $str = substr($str, 0, -1);
            //lệnh sql dùng chuỗi đã chuyển đổi
            $sql = "UPDATE $this->table SET {$str} WHERE id = :id";
        }
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($arrModel);
    }

    public function delete($model)
    {
        // TODO: Implement delete() method.
        $arrId = [];
        $arrId['id'] = $model->getId();
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($arrId);
    }

    public function get($id = null)
    {
        if ($id != null) {
            $sql = "SELECT * FROM $this->table WHERE id =" . $id;

        } else {
            $sql = "SELECT * FROM $this->table";
        }
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        if ($id == null) {
            return $req->fetchAll(PDO::FETCH_OBJ);
        } else {
            return $req->fetch();
        }
    }
}


