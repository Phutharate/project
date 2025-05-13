        @extends('layouts.app') {{-- หรือ layout ของคุณเอง --}}
        @section('content')

        <div class="container mt-4">
            <div class="card">
                <div class="card-header bg-success text-white">จองรถ</div>
                <div class="card-body">
                    <form action="{{ route('user-profiles.store') }}" method="POST">
                        @csrf
                    
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">คำนำหน้า</label>
                                <select class="form-control" name="prefix" required>
                                    <option value="">-- กรุณาเลือกคำนำหน้า --</option>
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
                            <div class="col-md-4">
                                <label class="form-label">เพศ</label>
                                <select class="form-control" name="gender" required>
                                    <option value="">-- กรุณาเลือกเพศ --</option>
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
                            <div class="col-md-3">
                                <label class="form-label">จำนวนผู้โดยสาร</label>
                                <select class="form-control" name="passenger_count" required>
                                    <option value="">-- กรุณาเลือกจำนวนผู้โดยสาร --</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        
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
                            
                            @push('scripts')
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const tripTypeSelect = document.getElementById('tripTypeSelect');
                                        const timeInputCol = document.getElementById('timeInputCol');
                                        const appointmentTimeInput = document.getElementById('appointment_time');
                            
                                        tripTypeSelect.addEventListener('change', function () {
                                            const value = this.value;
                                            if (value === 'ไปส่ง' || value === 'ไปรับ') {
                                                timeInputCol.style.display = 'block';
                                            } else {
                                                timeInputCol.style.display = 'none';
                                            }
                                        });
                            
                                        // Optionally set a default time to Thai timezone
                                        function setDefaultTime() {
                                            const now = new Date();
                                            const thailandTime = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Bangkok' }));
                                            const hours = thailandTime.getHours().toString().padStart(2, '0');
                                            const minutes = thailandTime.getMinutes().toString().padStart(2, '0');
                                            appointmentTimeInput.value = `${hours}:${minutes}`;
                                        }
                            
                                        setDefaultTime(); // Call this function to set the time to current time in Thailand
                            
                                    });
                                </script>
                            @endpush
                            

                            
                            <div class="row mb-3 mt-4">
                                <div class="col-md-6">
                                    <label class="form-label">สถานที่</label>
                                    <textarea class="form-control" name="location" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">วัตถุประสงค์ในการใช้รถ</label>
                                <textarea class="form-control" name="purpose" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </form>
                    

        @endsection
