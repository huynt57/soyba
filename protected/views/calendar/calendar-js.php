<script type="text/javascript">
    $(document).ready(function () {


        /* initialize the external events
         -----------------------------------------------------------------*/
        $('#external-events .fc-event').each(function () {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true, // maintain when user navigates (see docs on the renderEvent method)
                color: '#00bcd4'
            });
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
        /* initialize the calendar
         -----------------------------------------------------------------*/
        $('#calendar').fullCalendar({
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
                url: '<?php echo Yii::app()->createUrl('calendar/getCalendar'); ?>',
                type: 'POST', // Send post data
                error: function () {
                    alert('There was an error while fetching events.');
                }
            },
            eventDrop: function (event, delta, revertFunc) {
                var title = event.title;
                var start = event.start.format();
                var end = (event.end === null) ? start : event.end.format();
                $.ajax({
                    url: '<?php echo Yii::app()->createUrl('calendar/updateCalendar'); ?>',
                    data: {title: title, start: start, end: end},
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {

                        //revertFunc();
                    },
                    error: function () {
                        // revertFunc();

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
                        $('#number').val(json[0].number);
                        $('#date').val(json[0].inject_day);
                        if(json[0].done == 1) {
                            $('#isDone').attr('checked', 'true');
                        }

                    },
                });
                $("#modal1").openModal();


            }
        });
                $('#save-calendar').click(function () {
            var form = $('#calendar-form');
            var data = form.serialize();
            $.ajax({
                
                                url: '<?php echo Yii::app()->createUrl('calendar/updateDetailCalendar') ?>',
                                type: 'post',
                                data: data,
                                dataType: 'json',
                                success: function (response) {


                                },
                            });
                        });
    });

</script>