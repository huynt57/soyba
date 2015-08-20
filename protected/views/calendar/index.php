
<!--start container-->
<div class="container">
    <div class="section">

        <p class="caption">Cập nhật lịch tiêm của con bạn tại đây</p>
        <div class="divider"></div>
        <div id="full-calendar">              
            <div class="row">
                <div class="col s12 m3 l2">
                    <div id='external-events'>    
                        <h4 class="header">Các sự kiện</h4>
                        <div class='fc-event cyan'>Chưa tiêm</div>
                        <div class='fc-event teal'>Đã tiêm</div>
                    </div>
                </div>
                <div class="col s12 m9 l10">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>


    <?php $this->renderPartial('modal'); ?>
</div>
<?php $this->renderPartial('calendar-js') ?>
<!--end container-->