<!--start container-->
<div class="container">
    <div class="section">

        <p class="caption">Tables are a nice way to organize a lot of data. We provide a few utility classes to help you style your table as easily as possible. In addition, to improve mobile experience, all tables on mobile-screen widths are centered automatically.</p>
        <div class="divider"></div>

        <!--DataTables example-->
        <div id="table-datatables">
            <h4 class="header">DataTables example</h4>
            <div class="row">
                <div class="col s12 m8 l9">
                    <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>FacebookID</th>
                                <th>GoogleID</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Photo</th>
                                <th>Detail</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>FacebookID</th>
                                <th>GoogleID</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Photo</th>
                                <th>Detail</th>
                            </tr>
                        </tfoot>

                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo $user->id ?></td>
                                    <td><?php echo $user->facebook_id ?></td>
                                    <td><?php echo $user->google_id ?></td>
                                    <td><?php echo $user->dob ?></td>
                                    <td><?php echo $user->gender ?></td>
                                    <td><?php echo $user->photo ?></td>
                                    <td>Detail</td>
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
<!--end container-->
