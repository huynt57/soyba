<!--start container-->
<div class="container">
    <div class="section">

        <!--DataTables example-->
        <div id="table-datatables" ng-app="" ng-controller="GetDetailCtrl">
            <h4 class="header">Detail Patient: <?php echo $patient_info->name;  ?></h4>
            <?php //$this->renderPartial('add') ?>
            <div class="row">
                <div class="col s12">
                    <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>DOB</th>

                                <th>Gender</th>

                                <th>Detail</th>

                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>DOB</th>

                                <th>Gender</th>

                                <th>Detail</th>
                            </tr>
                        </tfoot>

                        <tbody>
                       
                                <tr>
                                    <td><?php echo $patient_info->patient_id ?></td>
                                    <td><?php echo $patient_info->name ?></td>
                                    <td><?php echo $patient_info->dob ?></td>
                                    <td><?php echo $patient_info->gender ?></td>
                                    <td>Detail</td>
                                </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
        <br>
        <div class="divider"></div> 
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

