<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // เรียกใช้งาน Controller ที่เป็นตัวแม่ของ Controller
use Illuminate\Http\Request; // เรียกใช้งาน Request เพื่อรับ Request มาจาก Client
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash; // เรียกใช้งาน Hash เพื่อใช้ในการ Hash Password
use Illuminate\Support\Facades\DB; // เรียกใช้งาน DB

// เป็นการ Import Table เข้ามายัง File RequestUserController Start
use App\Models\Prefixes;
use App\Models\Departmentes;
use App\Models\roles;
use App\Models\Employee_system_requests;
// เป็นการ Import Table เข้ามายัง File RequestUserController End


class RequestUserController extends Controller
{
    // แสดงหน้าแรกของ RequestUser Start
    public function index() {
        // ดึงข้อมูลจาก Table นั้นๆ และส่งออกไปยังหน้า requests_user Start
        $prefixes = Prefixes::all();
        $departmentes = Departmentes::all();
        $roles = roles::all();
        return view('requets_user', compact('prefixes', 'departmentes', 'roles'));
        // ดึงข้อมูลจาก Table นั้นๆ และส่งออกไปยังหน้า requests_user End
    }
    // แสดงหน้าแรกของ RequestUser Start

    // Function ส่ง Line Notify Start
    public function send_line_notify(Request $request) {

        $bcryptPattern = '/^\$2[ayb]\$.{56}$/';

        // ตรวจสอบรหัสว่ามีการส่งมาแบบ Hash หรือไม่ Hash ถ้า Hash ให้ส่งออกเป็นค่าว่างถ้าไม่ได้เป็นรูปแบบ hash ให้ส่งออกเป็นที่ถูกส่ง Request เข้ามา Start
        if(preg_match($bcryptPattern, $request->emp_password)) {
            $request->emp_password = '';
        } else {
            $request->emp_password = $request->emp_password;
        }
        // ตรวจสอบรหัสว่ามีการส่งมาแบบ Hash หรือไม่ Hash ถ้า Hash ให้ส่งออกเป็นค่าว่างถ้าไม่ได้เป็นรูปแบบ hash ให้ส่งออกเป็นที่ถูกส่ง Request เข้ามา End

        // ดึงข้อมูลจาก foreign Key เพื่อไปหา Primary Key นั้นๆ Start
        $prefixModel = Prefixes::find($request->prefix_id);
        $roleModel = roles::find($request->role_id);
        $departmentModel = Departmentes::find($request->department_id);
        // ดึงข้อมูลจาก foreign Key เพื่อไปหา Primary Key นั้นๆ End

        $sToken = "hpVGL2bIqLjCFNwrjnNblIxsAJdryGT4JiUBvjENMjI";
        // กำหนดสิ่งที่ส่งไปยัง Line Notify นั้นๆ Start
        $sMessage = "แจ้งเตือนการขอ User สำหรับใช้งานระบบ HoSXP!\r\n";
        $sMessage .= "วัน-เดือน-ปี เกิด: " . $request->birthdate . " \r\n";
        $sMessage .= "วัน-เดือน-ปี ที่เข้าทำงาน: " . $request->joindate . " \r\n";
        $sMessage .= "คำนำหน้า: " . $prefixModel->name . " \r\n";
        $sMessage .= "ชื่อภาษาไทย: " . $request->thai_first_name . " \r\n";
        $sMessage .= "นามสกุลภาษาไทย: " . $request->thai_last_name . " \r\n";
        $sMessage .= "ชื่อภาษาอังกฤษ: " . $request->eng_first_name . " \r\n";
        $sMessage .= "นามสกุลภาษาอังกฤษ: " . $request->eng_last_name . " \r\n";
        $sMessage .= "เลขบัตรประจำตัวประชาชน: " . $request->cid . " \r\n";
        $sMessage .= "ตำแหน่ง: " . $roleModel->name . " \r\n";
        $sMessage .= "แผนก: " . $departmentModel->name . " \r\n";
        $sMessage .= "ใบประกอบวิชาชีพ: " . $request->medical_license_no . " \r\n";
        $sMessage .= "วัน-เดือน-ปี ที่ออกใบประกอบ: " . $request->medical_license_start . " \r\n";
        $sMessage .= "วัน-เดือน-ปี ที่หมดอายุ: " . $request->medical_license_expire . " \r\n";
        $sMessage .= "Username: " . $request->emp_username . " \r\n";
        $sMessage .= "Password: " . $request->emp_password . " \r\n";
        // กำหนดสิ่งที่ส่งไปยัง Line Notify นั้นๆ End

        // ส่ง Line Notify Start
        $chOne = curl_init();
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt( $chOne, CURLOPT_POST, 1);
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage);
        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $chOne );
        // ส่ง Line Notify End

        // ตรวจสอบการส่ง Line Notify ว่าสำเร็จหรือไม่ ถ้าสำเร็จส่งออกเป็น true ไม่สำเร็จส่งออกเป็น false Start
        if(isset($result)) {
            return true;
        } else {
            return false;
        }
        // ตรวจสอบการส่ง Line Notify ว่าสำเร็จหรือไม่ ถ้าสำเร็จส่งออกเป็น true ไม่สำเร็จส่งออกเป็น false End
    }
    // Function ส่ง Line Notify End

    // ดึงข้อมูลทั้งหมดแล้วส่งไปในรูปแบบ Table Start
    public function request_fetch_all() {
        // ดึงข้อมูลทั้งหมดจาก Table:employee_system_requests Start
        $employee_system_request = Employee_system_requests::all();
        // ดึงข้อมูลทั้งหมดจาก Table:employee_system_requests End
        $output = '';
        // fetch ข้อมูลและส่งออกไปยังหน้าที่มีการร้องขอข้อมูลโดยส่งไปในรูปแบบของตารางหรือ Table Start
		if ($employee_system_request->count() > 0) {
			$output .= '<table class="table table-striped align-middle dt-responsive nowrap" style="width: 100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>วันที่ส่งคำร้อง</th>
                <th>Fullname</th>
                <th>แผนก</th>
                <th>ตำแหน่ง</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($employee_system_request as $esr) {
				$output .= '<tr>
                <td>' . $esr->id . '</td>
                <td>' . $esr->created_at . '</td>
                <td>' . $esr->prefixes->name . $esr->thai_first_name . ' ' . $esr->thai_first_name . '</td>
                <td>' . $esr->departmentes->name . '</td>
                <td>' . $esr->roles->name . '</td>
                <td>
                  <a href="#" id="' . $esr->id . '" class="btn btn-outline-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#request_user_modal">Edit</a>

                  <a href="#" id="' . $esr->id . '"   class="btn btn-outline-primary mx-1 detailIcon" data-bs-toggle="modal" data-bs-target="#request_user_detail_modal">Detail</a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
            // fetch ข้อมูลและส่งออกไปยังหน้าที่มีการร้องขอข้อมูลโดยส่งไปในรูปแบบของตารางหรือ Table End
		} else {
            // ถ้าไม่มีข้อมูลใน Table นี้บน Database ให้ส่งออกไปเป็นข้อความ = No record present in the database! Start
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
            // ถ้าไม่มีข้อมูลใน Table นี้บน Database ให้ส่งออกไปเป็นข้อความ = No record present in the database! End
		}
    }
    // ดึงข้อมูลทั้งหมดแล้วส่งไปในรูปแบบ Table End

    // function การเพิ่มข้อมูลไปยัง Database Start
    public function request_create(Request $request) {
        $prefix_id = $request->prefix_id;
        $department_id = $request->department_id;
        $role_id = $request->role_id;

        if($request->prefix_id === '0') {
            return response()->json([
                'status' => 400,
                'title' => 'Error!',
                'message' => "กรุณาเลือกคำนำหน้าด้วย!",
                'icon' => 'error'
            ]);
        } else if($request->department_id === '0') {
            return response()->json([
                'status' => 400,
                'title' => 'Error!',
                'message' => "กรุณาเลือกแผนกด้วย!",
                'icon' => 'error'
            ]);
        } else if($request->role_id === '0') {
            return response()->json([
                'status' => 400,
                'title' => 'Error!',
                'message' => "กรุณาเลือกตำแหน่งด้วย!",
                'icon' => 'error'
            ]);
        } else {
            try {
                $hashedPassword = Hash::make($request->emp_password);

                $requestUserData = [
                    'birthdate' => $request->birthdate,
                    'joindate' => $request->joindate,
                    'prefix_id' => $request->prefix_id,
                    'thai_first_name' => $request->thai_first_name,
                    'thai_last_name' => $request->thai_last_name,
                    'eng_first_name' => $request->eng_first_name,
                    'eng_last_name' => $request->eng_last_name,
                    'cid' => $request->cid,
                    'department_id' => $request->department_id,
                    'role_id' => $request->role_id,
                    'medical_license_no' => $request->medical_license_no,
                    'medical_license_start' => $request->medical_license_start,
                    'medical_license_expire' => $request->medical_license_expire,
                    'emp_username' => $request->emp_username,
                    'emp_password' => $hashedPassword,
                ];

                if(Employee_system_requests::create($requestUserData)) {
                    $requestUserData['emp_password'] = $request->emp_password;
                    $requestUser = Request::create('/', 'POST', $requestUserData);

                    $request_user_controller = new RequestUserController();

                    // เรียกใช้ฟังก์ชัน send_line_notify
                    $responseUser = $request_user_controller->send_line_notify($requestUser);

                    if($responseUser === true) {
                        return response()->json([
                            'status' => 200,
                            'title' => 'Added!',
                            'message' => 'ส่งคำร้องเสร็จสิ้น',
                            'icon' => 'success'
                        ]);
                    } else {
                        return response()->json([
                            'status' => 400,
                            'title' => 'Error!',
                            'message' => 'การส่งคำร้องมีปัญหากรุณาติดต่อทีม IT!',
                            'icon' => 'error'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 400,
                        'title' => 'Error!',
                        'message' => 'ไม่สามารถบันทึกข้อมูลลง Database ได้กรุณาติดต่อทีม IT',
                        'icon' => 'error'
                    ]);
                }
            } catch(\Exception $e) {
                Log::error('Error saving employee system request: ' . $e->getMessage(), [
                    'exception' => $e
                ]);

                return response()->json([
                    'status' => 500,
                    'title' => 'Error!',
                    'message' => 'ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อผิดพลาด',
                    'icon' => 'error'
                ]);
            }
        }
    }
    // function การเพิ่มข้อมูลไปยัง Database End

    // Function การดึงข้อมูลแค่ 1 record Start
    public function request_fetch_one(Request $request) {
        $id = $request->id;
        $employee_system_request = Employee_system_requests::find($id);
        return response()->json($employee_system_request);
    }
    // Function การดึงข้อมูลแค่ 1 record End

    // Function การ Update ข้อมูลไปยัง Database Start
    public function request_update(Request $request) {
        $id = $request->request_user_id;
        $employee_system_request = Employee_system_requests::find($id);

        if($request->prefix_id === '0') {
            return response()->json([
                'status' => 400,
                'title' => 'Error!',
                'message' => "กรุณาเลือกคำนำหน้าด้วย!",
                'icon' => 'error'
            ]);
        } else if($request->department_id === '0') {
            return response()->json([
                'status' => 400,
                'title' => 'Error!',
                'message' => "กรุณาเลือกแผนกด้วย!",
                'icon' => 'error'
            ]);
        } else if($request->role_id === '0') {
            return response()->json([
                'status' => 400,
                'title' => 'Error!',
                'message' => "กรุณาเลือกตำแหน่งด้วย!",
                'icon' => 'error'
            ]);
        } else {
            $hashedPassword = '';

            $bcryptPattern = '/^\$2[ayb]\$.{56}$/';

            if(preg_match($bcryptPattern, $request->emp_password)) {
                $hashedPassword = $request->emp_password;
            } else {
                $hashedPassword = Hash::make($request->emp_password);
            }

            try {
                $requestUserData = [
                    'birthdate' => $request->birthdate,
                    'joindate' => $request->joindate,
                    'prefix_id' => $request->prefix_id,
                    'thai_first_name' => $request->thai_first_name,
                    'thai_last_name' => $request->thai_last_name,
                    'eng_first_name' => $request->eng_first_name,
                    'eng_last_name' => $request->eng_last_name,
                    'cid' => $request->cid,
                    'department_id' => $request->department_id,
                    'role_id' => $request->role_id,
                    'medical_license_no' => $request->medical_license_no,
                    'medical_license_start' => $request->medical_license_start,
                    'medical_license_expire' => $request->medical_license_expire,
                    'emp_username' => $request->emp_username,
                    'emp_password' => $hashedPassword,
                ];

                if($employee_system_request->update($requestUserData)) {
                    $requestUserData['emp_password'] = $request->emp_password;
                    $requestUser = Request::create('/', 'POST', $requestUserData);

                    $request_user_controller = new RequestUserController();

                    // เรียกใช้ฟังก์ชัน send_line_notify
                    $responseUser = $request_user_controller->send_line_notify($requestUser);

                    if($responseUser === true) {
                        return response()->json([
                            'status' => 200,
                            'title' => 'Added!',
                            'message' => 'ส่งคำร้องเสร็จสิ้น',
                            'icon' => 'success'
                        ]);
                    } else {
                        return response()->json([
                            'status' => 400,
                            'title' => 'Error!',
                            'message' => 'การส่งคำร้องมีปัญหากรุณาติดต่อทีม IT!',
                            'icon' => 'error'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 400,
                        'title' => 'Error!',
                        'message' => 'ไม่สามารถบันทึกข้อมูลลง Database ได้กรุณาติดต่อทีม IT',
                        'icon' => 'error'
                    ]);
                }
            } catch(\Exception $e) {
                Log::error('Error saving employee system request: ' . $e->getMessage(), [
                    'exception' => $e
                ]);

                return response()->json([
                    'status' => 500,
                    'title' => 'Error!',
                    'message' => 'ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อผิดพลาด',
                    'icon' => 'error'
                ]);
            }
        }
    }
    // Function การ Update ข้อมูลไปยัง Database End

    // Function detail เป็นการดึงข้อมูลเฉพาะและ Join ตารางหลังจากนั้นส่งกลับแบบ JSON Start
    public function request_detail(Request $request) {
        $id = $request->id;
        // $employee_system_request = Employee_system_requests::find($id);
        $employee_system_request = DB::table('employee_system_requests as esr')
            ->join('prefixes as pf', 'esr.prefix_id', '=', 'pf.id')
            ->join('departmentes as dpm', 'esr.department_id', '=', 'dpm.id')
            ->join('roles as r', 'esr.role_id', '=', 'r.id')
            ->select(
                'pf.name as prefix_name',
                'esr.thai_first_name',
                'esr.thai_last_name',
                'esr.eng_first_name',
                'esr.eng_last_name',
                'esr.cid',
                'r.name as role_name',
                'dpm.name as department_name',
                'esr.created_at'
            )
            ->where('esr.id', '=', $id)
            ->first();
        return response()->json($employee_system_request);
    }
    // Function detail เป็นการดึงข้อมูลเฉพาะและ Join ตารางหลังจากนั้นส่งกลับแบบ JSON End
}
