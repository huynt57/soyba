
<!--start container-->
<div class="container">
    <div class="section">

        <p class="caption">FullCalendar is a jQuery plugin that provides a full-sized, drag & drop event calendar like the one below. It uses AJAX to fetch events on-the-fly and is easily configured to use your own feed format. It is visually customizable with a rich API.</p>
        <div class="divider"></div>
        <div id="full-calendar">              
            <div class="row">
                <div class="col s12 m4 l3">
                    <div id='external-events'>    
                        <h4 class="header">Draggable Events</h4>
                        <div class='fc-event cyan'>March Invoices</div>
                        <div class='fc-event teal'>Call Emy</div>
                        <div class='fc-event cyan darken-1'>Dinner with Team</div>
                        <div class='fc-event cyan accent-4'>Meeting with Support Team</div>
                        <div class='fc-event teal accent-4'>Meeting with Sales Team</div>
                        <div class='fc-event light-blue accent-3'>Design an iOS App</div>
                        <div class='fc-event light-blue accent-4'>Company Party</div>
                        <p>
                            <input type='checkbox' id='drop-remove' />
                            <label for='drop-remove'>remove after drop</label>
                        </p>
                    </div>
                </div>
                <div class="col s12 m8 l9">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large red">
            <i class="large mdi-editor-mode-edit"></i>
        </a>
        <ul>
            <li><a href="css-helpers.html" class="btn-floating red"><i class="large mdi-communication-live-help"></i></a></li>
            <li><a href="app-widget.html" class="btn-floating yellow darken-1"><i class="large mdi-device-now-widgets"></i></a></li>
            <li><a href="app-calendar.html" class="btn-floating green"><i class="large mdi-editor-insert-invitation"></i></a></li>
            <li><a href="app-email.html" class="btn-floating blue"><i class="large mdi-communication-email"></i></a></li>
        </ul>
    </div>
    <!-- Floating Action Button -->
</div>
<!--end container-->