<?php 
require_once 'App/Core/db.php';

class Lop extends DB {
    public function getlop() {
        $sql = "SELECT * FROM tbl_lop";
        $stmt = sqlsrv_query($this->db, $sql);
        
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));  // In lỗi nếu truy vấn thất bại
        }

        $data = [];
        // Kiểm tra xem có hàng dữ liệu nào không
        if (sqlsrv_has_rows($stmt)) {
            // Lặp qua các kết quả và lưu vào mảng $data
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
        }

        return $data;
    }
}
?>
