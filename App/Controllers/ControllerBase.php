<?php 
require_once 'App/Models/SinhVien.php';
require_once 'App/Models/Lop.php';

class ControllerBase {
    public function render($view, $params = []) {
        extract($params);
        require_once 'App/Views/'.$view.'.php';
    }

    public function index() {
        $dssv = new SinhVien();
        $dssv = $dssv->getsvbylop();
        $this->render('index', ['dssv' => $dssv]);
    }

    public function create() {
        $lop = new Lop();
        $lops = $lop->getlop();
        $this->render('create', ['lops' => $lops]);
    }

    public function themSV(){
        if(isset($_POST['ten_sv']) && $_POST['ngaysinh'] && $_POST['gioitinh'] && ($_POST['ma_lop']))
        {
            $ten_sv = $_POST['ten_sv'];
            $ngaysinh = $_POST['ngaysinh'];
            $gioitinh = $_POST['gioitinh'];
            $ma_lop = $_POST['ma_lop'];
            $sv = new SinhVien();
            if($sv->themSV($ten_sv, $ngaysinh, $gioitinh, $ma_lop)){
                header("Location: index.php");
                exit();
            } else {
                echo "Đã xảy ra lỗi khi thêm sinh viên!";
            }
            
        }
    }

    public function edit($id) {
        $lop = new Lop();
        $lops = $lop->getlop();
        $sv = new SinhVien();
        $sv = $sv->getsvbyid($id);
        $sv = !empty($sv) ? $sv[0] : null;
        $this->render('edit', ['sv' => $sv, 'lops' => $lops]);
    }

    // public function suaSV($id){
    //     if(empty($_POST['ten_sv']) && $_POST['ngaysinh'] && $_POST['gioitinh'] && ($_POST['ma_lop']))
    //     {
    //         $ten_sv = $_POST['ten_sv'];
    //         $ngaysinh = $_POST['ngaysinh'];
    //         $gioitinh = $_POST['gioitinh'];
    //         $ma_lop = $_POST['ma_lop'];
    //         $sv = new SinhVien();
    //         if($sv->suaSV($id, $ten_sv, $ngaysinh, $gioitinh, $ma_lop)){
    //             header("Location: index.php");
    //             exit();
    //         } else {
    //             echo "Đã xảy ra lỗi khi sửa sinh viên!";
    //         }
            
    //     }
    // }
    public function suaSV($id){
    // Kiểm tra phương thức yêu cầu HTTP
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Kiểm tra các giá trị từ form
        if (!empty($_POST['ten_sv']) && !empty($_POST['ngaysinh']) && !empty($_POST['gioitinh']) && !empty($_POST['ma_lop'])) {
            // Làm sạch dữ liệu đầu vào
            $ten_sv = htmlspecialchars(trim($_POST['ten_sv']));
            $ngaysinh = htmlspecialchars(trim($_POST['ngaysinh']));
            $gioitinh = htmlspecialchars(trim($_POST['gioitinh']));
            $ma_lop = htmlspecialchars(trim($_POST['ma_lop']));

            // Khởi tạo đối tượng SinhVien và gọi phương thức suaSV
            $sv = new SinhVien();
            if ($sv->suaSV($id, $ten_sv, $ngaysinh, $gioitinh, $ma_lop)) {
                // Nếu cập nhật thành công, chuyển hướng về trang index.php
                header("Location: index.php");
                exit();
            } else {
                // Nếu cập nhật thất bại, hiển thị thông báo lỗi
                echo "Đã xảy ra lỗi khi sửa sinh viên! Vui lòng thử lại.";
            }
        } else {
            // Nếu các giá trị từ form không hợp lệ
            echo "Vui lòng điền đầy đủ thông tin.";
        }
    } else {
        // Nếu không phải là yêu cầu POST
        echo "Yêu cầu không hợp lệ.";
    }
}


    public function XoaSV($id){
        $sv = new SinhVien();
        if($sv->xoaSV($id)){
            header("Location: index.php");
            exit();
        } else {
            echo "Đã xảy ra lỗi khi xóa sinh viên!";
        }
    }
}
?>
