@extends('layouts.app')

@section('content')
<div class="container">
    <h3>ปฏิทินการจองรถ</h3>
    <div id="calendar"></div>

    <!-- JSON data ซ่อนอยู่ใน DOM -->
<script type="application/json" id="calendar-events">
    {!! json_encode($events->map(function($event) {
        return [
            
            'first_name' => optional($event->user)->first_name,  // ใช้ optional() เพื่อหลีกเลี่ยง error ถ้า $event->user เป็น null
            'last_name' => optional($event->user)->last_name,
            'gender' => optional($event->user)->gender,
            'position' => optional($event->user)->position,
            'user_group' => optional($event->user)->user_group,
            'registered_at' => optional($event->user)->registered_at,
            'location' => optional($event->user)->location,
        ];
    })) !!}
</script>



</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const eventData = JSON.parse(document.getElementById('calendar-events').textContent);

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'th',
            events: eventData, // ✅ สำคัญ: เพิ่ม eventData เข้าไปที่นี่

            eventClick: function(info) {
                const event = info.event;
                const props = event.extendedProps;

                Swal.fire({
                    title: `<strong>${event.title}</strong>`,
                    html: `
                        <div style="text-align: left">
                            <p><strong>ชื่อ:</strong> ${props.prefix} ${props.first_name} ${props.last_name}</p>
                            <p><strong>เพศ:</strong> ${props.gender}</p>
                            <p><strong>ตำแหน่ง:</strong> ${props.position}</p>
                            <p><strong>กลุ่มผู้ใช้:</strong> ${props.user_group}</p>
                            <p><strong>วันที่ลงทะเบียน:</strong> ${props.registered_at}</p>
                            <p><strong>สถานที่:</strong> ${props.location}</p>
                            <p><strong>จุดประสงค์:</strong> ${props.description}</p>
                        </div>
                    `,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'แก้ไข',
                    cancelButtonText: 'ปิด'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const eventId = event.id;
                        window.location.href = '/user-profiles/' + eventId + '/edit';
                    }
                });
            }
        });

        calendar.render();
    });
</script>

@endsection


