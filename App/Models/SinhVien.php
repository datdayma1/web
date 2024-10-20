<?php
require_once 'App/Core/db.php';
class SinhVien extends DB {
    public function getsvbylop() {
        $data = [];
        $sql = "SELECT * FROM tbl_sinhvien";
        $stmt = sqlsrv_query($this->db, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true)); ///// Hiển thị lỗi nếu có
        }

        if (sqlsrv_has_rows($stmt)) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $ma_lop = $row['ma_lop'];
                $lop_sql = "SELECT * FROM tbl_lop WHERE ma_lop = ?";
                $lop_stmt = sqlsrv_query($this->db, $lop_sql, [$ma_lop]);

                if ($lop_stmt && sqlsrv_has_rows($lop_stmt)) {
                    while ($row_lop = sqlsrv_fetch_array($lop_stmt, SQLSRV_FETCH_ASSOC)) {
                        $row['ten_lop'] = $row_lop['ten_lop'];
                    }
                }
                $data[] = $row;
            }
        }

        return $data;
    }

    public function themSV($ten_sv, $ngaysinh, $gioitinh, $ma_lop) {
        $sql = "INSERT INTO tbl_sinhvien (ten_sv, ngaysinh, gioitinh, ma_lop) VALUES (?, ?, ?, ?)";
        $params = [$ten_sv, $ngaysinh, $gioitinh, $ma_lop];
        $stmt = sqlsrv_query($this->db, $sql, $params);

        if ($stmt === false) {
            return false;
        }

        return true;
    }

    public function getsvbyid($id) {
        $sql = "SELECT * FROM tbl_sinhvien WHERE ma_sv = ?";
        $stmt = sqlsrv_query($this->db, $sql, [$id]);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = [];
        if (sqlsrv_has_rows($stmt)) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function suaSV($id, $ten_sv, $ngaysinh, $gioitinh, $ma_lop) {
        $sql = "UPDATE tbl_sinhvien SET ten_sv = ?, ngaysinh = ?, gioitinh = ?, ma_lop = ? WHERE ma_sv = ?";
        $params = [$ten_sv, $ngaysinh, $gioitinh, $ma_lop, $id];
        $stmt = sqlsrv_query($this->db, $sql, $params);

        if ($stmt === false) {
            return false;
        }

        return true;
    }

    public function xoaSV($id) {
        $sql = "DELETE FROM tbl_sinhvien WHERE ma_sv = ?";
        $stmt = sqlsrv_query($this->db, $sql, [$id]);

        if ($stmt === false) {
            return false;
        }

        return true;
    }
}
?>
