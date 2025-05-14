@extends('layouts.app') {{-- หรือ layout ของคุณเอง --}}
@section('content')

<div class="container-fluid mt-4 px-5" style="height: 100vh;">
    <div class="card" style="height: 100%; display: flex; flex-direction: column;">
        <div class="card-header bg-success text-white">จองรถ</div>
        <div class="card-body flex-grow-1">
            <form action="{{ route('user-profiles.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-1">
                        <label class="form-label">คำนำหน้า</label>
                        <select class="form-control" name="prefix" required>
                            <option value="">----</option>
                            <option value="คุณ">คุณ</option>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นาวสาว">นางสาว</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label">เพศ</label>
                        <select class="form-control" name="gender" required>
                            <option value="">----</option>
                            <option value="ชาย">ชาย</option>
                            <option value="หญิง">หญิง</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ตำแหน่ง</label>
                        <select class="form-control" name="position" required>
                            <option value="">-- กรุณาเลือกตำแหน่ง --</option>
                            <option value="ผู้จัดการ">ผู้จัดการ</option>
                            <option value="พนักงาน">พนักงาน</option>
                            <option value="หัวหน้าแผนก">หัวหน้าแผนก</option>
                            <option value="เจ้าหน้าที่">เจ้าหน้าที่</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">กลุ่ม</label>
                        <select class="form-control" name="user_group" required>
                            <option value="">-- กรุณาเลือกกลุ่ม --</option>
                            <option value="ผู้จัดการ">วิทยาศาสตร์</option>
                            <option value="พนักงาน">คณิต</option>
                            <option value="หัวหน้าแผนก">ภาษาไทย</option>
                            <option value="เจ้าหน้าที่">อังกฤษ</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
    <div class="col-md-2">
        <label class="form-label">จำนวนผู้โดยสาร</label>
        <select class="form-control small-select" name="passenger_count" required>

            <option value="">-- เลือก --</option>
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">พนักงานขับรถ</label>
        <input type="text" class="form-control" name="driver_name" id="driver_name" readonly>
    </div>
    <div class="col-md-3">
        <label class="form-label">ยี่ห้อรถ</label>
        <input type="text" class="form-control" name="car_brand" id="car_brand" readonly>
    </div>
    <div class="col-md-4">
        <label class="form-label">ทะเบียนรถ</label>
        <input type="text" class="form-control" name="car_license" id="car_license" readonly>
    </div>
</div>



                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">วันที่</label>
                        <input type="date" class="form-control" name="registered_at" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">ประเภทการเดินทาง</label>
                        <select class="form-control" name="trip_type" id="tripTypeSelect" required>
                            <option value="">-- กรุณาเลือกประเภทการเดินทาง --</option>
                            <option value="ไปส่งและรอรับกลับ">ไปส่งและรอรับกลับ</option>
                            <option value="ไปส่ง">ไปส่ง</option>
                            <option value="ไปรับ">ไปรับ</option>
                        </select>
                    </div>

                    <div class="col-md-3" id="timeInputCol" style="display: none;">
                        <label class="form-label">เวลานัดหมาย</label>
                        <input type="time" class="form-control" name="appointment_time" id="appointment_time" placeholder="กรุณากรอกเวลา" pattern="\d{2}:\d{2}">
                    </div>
                </div>

                <div class="row mb-3 mt-4">
                    <div class="col-md-6">
                        <label class="form-label">สถานที่</label>
                        <textarea class="form-control" name="location" rows="11" required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">วัตถุประสงค์ในการใช้รถ</label>
                        <textarea class="form-control" name="purpose" rows="11" required></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">บันทึก</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const passengerSelect = document.querySelector('select[name="passenger_count"]');
    const driverNameInput = document.getElementById('driver_name');
    const carBrandInput = document.getElementById('car_brand');
    const carLicenseInput = document.getElementById('car_license');
    const tripTypeSelect = document.getElementById('tripTypeSelect');
    const timeInputCol = document.getElementById('timeInputCol');
    const appointmentTimeInput = document.getElementById('appointment_time');

    // ฟังก์ชันที่อัปเดตข้อมูลของรถตามจำนวนผู้โดยสาร
    const carOptions = {
        1: { driver: 'สมชาย', brand: 'Toyota Vios', license: 'กข 1234' },
        2: { driver: 'สมหญิง', brand: 'Honda City', license: 'ขค 5678' },
        3: { driver: 'สุชาติ', brand: 'Isuzu MU-X', license: 'งง 8888' },
        4: { driver: 'สมชาย', brand: 'Nissan Altima', license: 'ขง 2222' },
        5: { driver: 'สมหญิง', brand: 'Mazda CX-5', license: 'ขจ 3333' },
        6: { driver: 'สุชาติ', brand: 'Toyota Fortuner', license: 'ขก 4444' },
        7: { driver: 'สมชาย', brand: 'Mitsubishi Pajero', license: 'ขค 5555' },
        8: { driver: 'สมหญิง', brand: 'Ford Everest', license: 'ขจ 6666' },
        9: { driver: 'สุชาติ', brand: 'Hyundai Tucson', license: 'ขง 7777' },
        10: { driver: 'สมชาย', brand: 'Chevrolet Trailblazer', license: 'ขข 8888' },
    };

    passengerSelect.addEventListener('change', function () {
        const selected = this.value;
        if (carOptions[selected]) {
            const car = carOptions[selected];
            driverNameInput.value = car.driver;
            carBrandInput.value = car.brand;
            carLicenseInput.value = car.license;
        } else {
            driverNameInput.value = '';
            carBrandInput.value = '';
            carLicenseInput.value = '';
        }
    });

    tripTypeSelect.addEventListener('change', function () {
    const value = this.value;
    if (value === 'ไปส่ง' || value === 'ไปรับ') {
        timeInputCol.style.display = 'block';
        setDefaultTime();
    } else {
        timeInputCol.style.display = 'none';
        appointmentTimeInput.value = '';
    }
});


function setDefaultTime() {
    const now = new Date();
    // แปลงเวลาตามโซนเวลา 'Asia/Bangkok'
    const thailandTime = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Bangkok' }));

    // ดึงชั่วโมงและนาทีจากเวลาที่แปลงแล้ว
    const hours = thailandTime.getHours().toString().padStart(2, '0'); // ชั่วโมงในรูปแบบ 24 ชั่วโมง
    const minutes = thailandTime.getMinutes().toString().padStart(2, '0'); // นาที

    // ตั้งค่าเวลาใน input โดยไม่มี AM/PM
    appointmentTimeInput.value = `${hours}:${minutes}`;
}




    setDefaultTime();  // ตั้งเวลาเริ่มต้นเมื่อหน้าโหลด
});

</script>
@endpush
