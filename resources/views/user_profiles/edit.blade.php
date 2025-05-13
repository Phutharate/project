@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-white">แก้ไขข้อมูลการจองรถ</div>
        <div class="card-body">
            <form action="{{ route('user-profiles.update', $userProfile->id) }}" method="POST">
                @csrf
                @method('PUT')  {{-- จำเป็นสำหรับ Laravel เพื่อบอกว่าเป็น method PUT --}}
            
            
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">คำนำหน้า</label>
                        <select class="form-control" name="prefix" required>
                            <option value="">-- กรุณาเลือกคำนำหน้า --</option>
                            <option value="คุณ" @selected(old('prefix', $userProfile->prefix) == 'คุณ')>คุณ</option>
                            <option value="นาย" @selected(old('prefix', $userProfile->prefix) == 'นาย')>นาย</option>
                            <option value="นาง" @selected(old('prefix', $userProfile->prefix) == 'นาง')>นาง</option>
                            <option value="นาวสาว" @selected(old('prefix', $userProfile->prefix) == 'นาวสาว')>นางสาว</option>
                        </select>
                        
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $userProfile->first_name) }}" required>

                    </div>
                    <div class="col-md-4">
                        <label class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="last_name" value="{{ old('first_name', $userProfile->last_name) }}" required>

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
                    <div class="col-md-5">
                        <label class="form-label">วันที่</label>
                        <input type="date" class="form-control" name="registered_at" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">สถานที่</label>
                        <input type="text" class="form-control" name="location" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">วัตถุประสงค์ในการใช้รถ</label>
                        <input type="text" class="form-control" name="purpose" required>
                    </div>
                </div>
                
               
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </form>
            
        </div>
    </div>
</div>

@endsection
    