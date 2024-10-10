<?php 
require_once 'App/Core/db.php';

class Lop extends DB {
    public function getlop() {
        // Câu lệnh SQL để lấy dữ liệu từ bảng 'tbl_lop'
        $sql = "SELECT * FROM tbl_lop";
        
        // Thực thi truy vấn sử dụng sqlsrv_query
        $stmt = sqlsrv_query($this->db, $sql);
        
        // Kiểm tra nếu truy vấn thất bại và in lỗi
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));  // In lỗi ra màn hình nếu có vấn đề
        }

        $data = [];
        
        // Kiểm tra xem truy vấn có trả về hàng nào không
        if (sqlsrv_has_rows($stmt)) {
            // Lặp qua từng dòng kết quả và lưu vào mảng $data
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
        }

        // Trả về mảng chứa các dòng dữ liệu
        return $data;
    }
}
?>
