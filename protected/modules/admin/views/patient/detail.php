<!--start container-->
<div class="container">
    <div class="section">

        <!--DataTables example-->
        <div id="table-datatables" ng-app="" ng-controller="GetDetailCtrl">
            <h4 class="header">Detail Patient: <?php echo $patient_info->name; ?></h4>
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
                            <?php foreach ($patient_info as $iinfo): ?>
                                <tr>
                                    <td><?php echo $info->patient_id ?></td>
                                    <td><?php echo $info->name ?></td>
                                    <td><?php echo $info->dob ?></td>

                                    <td><?php echo $info->gender ?></td>
                                    <td>
                                        <i class="mdi-image-edit"></i>

                                        <a href="<?php echo Yii::app()->createUrl('admin/user/delete?user_id=' . $user->user_id) ?> " onclick="if (!confirm('Sure ?? Cannot rollback')) {
                                                            return false;
                                                        }" id="del_user"><i class="mdi-action-delete"></i></a>
                                        <a class="waves-effect waves-light modal-trigger" href="#modal2" user_id = "<?php echo $user->user_id ?>" ng-click = "getDetail(<?php echo $user->user_id ?>)"><i class="mdi-image-details"></i></a>
                                        <?php $this->renderPartial('detail', array('id' => $user->user_id)) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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

