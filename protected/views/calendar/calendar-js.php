<script type="text/javascript">
    $(document).ready(function () {


        /* initialize the external events
         -----------------------------------------------------------------*/
        $('#external-events .fc-event').each(function () {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
               // stick: true, // maintain when user navigates (see docs on the renderEvent method)
                color: '#00bcd4'
            });
            // make the event draggable using jQuery UI
//            $(this).draggable({
//                zIndex: 999,
//                revert: true, // will cause the event to go back to its
//                revertDuration: 0  //  original position after the drag
//            });
        });
        /* initialize the calendar
         -----------------------------------------------------------------*/
        $('#calendar').fullCalendar({
            lang: 'vi',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: '2015-05-12',
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            eventLimit: true, // allow "more" link when too many events
            events: {
                beforeSend: function () {
                    Materialize.toast('Đang lấy dữ liệu', 3000, 'rounded');
                },
                url: '<?php echo Yii::app()->createUrl('calendar/getCalendar'); ?>',
                type: 'POST', // Send post data
                success: function () {
                    Materialize.toast('Lấy dữ liệu thành công', 3000, 'rounded');
                },
                error: function () {
                    Materialize.toast('Có lỗi trong quá trình lấy dữ liệu, vui lòng thử lại sau', 3000, 'rounded');
                }
            },
            eventDrop: function (event, delta, revertFunc) {
                var title = event.title;
                var start = event.start.format();
                var end = (event.end === null) ? start : event.end.format();
                var id = event.id;
                $.ajax({
                    beforeSend: function () {
                        Materialize.toast('Đang cập nhật', 3000, 'rounded');
                    },
                    url: '<?php echo Yii::app()->createUrl('calendar/updateCalendar'); ?>',
                    data: {title: title, start: start, end: end, id: id},
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {

                        Materialize.toast('Cập nhật thành công', 3000, 'rounded');
                    },
                    error: function () {
                        Materialize.toast('Có lỗi xảy ra, vui lòng thử lại sau', 3000, 'rounded')

                    }
                });
            },
            eventClick: function (calEvent, jsEvent, view) {

//                alert('Event: ' + calEvent.title);
//                alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
//                alert('View: ' + view.name);
//
//                // change the border color just for fun
//                $(this).css('border-color', 'red');

                $.ajax({
                    beforeSend: function () {
                        $('#basic-form').hide();
                        $('#loading').show();

                    },
                    url: '<?php echo Yii::app()->createUrl('calendar/GetDetailCalendar') ?>',
                    type: 'post',
                    data: {id: calEvent.id},
                    dataType: 'json',
                    success: function (response) {
                        var json = response.data;
                        $('#loading').hide();
                        $('#basic-form').show();
                        $('#name').val(json[0].name);
                        $('#id').val(calEvent.id);
                        $('#number').val(json[0].number);
                        $('#date').val(json[0].inject_day);
                        if (json[0].done == "1") {
                            $('#isDone').prop('checked', true);
                        } else {
                            $('#isDone').prop('checked', false);
                        }

                    },
                });
                $("#modal1").openModal();


            }
        });
        $('#save-calendar').click(function () {
            //  var form = $('#calendarform');
            var done;
            var date = $('#date').val();
            if ($('#isDone').is(':checked')) {
                done = 1;
            } else {
                done = 0;
            }
            var note = $('#note').val();
            var id = $('#id').val();
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('calendar/updateDetailCalendar') ?>',
                type: 'post',
                data: {date: date, done: done, id: id, note: note},
                dataType: 'json',
                success: function (response) {
                    $("#modal1").closeModal();
                    Materialize.toast('Cập nhật thành công', 3000, 'rounded');
                    $('#calendar').fullCalendar('refetchEvents');
                },
                error: function () {
                    $("#modal1").closeModal();
                    Materialize.toast('Có lỗi xảy ra, vui lòng thử lại sau', 3000, 'rounded');
                },
            });
        });
    });

</script>