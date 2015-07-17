<div id="modal2" class="modal" style="width: 50%; height: auto;" >

    <div class="col s12 m12 l6" ng-repeat="item in info.patient_info">
        <div id="profile-card" class="card">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/user-bg.jpg" alt="user background">
            </div>
            <div class="card-content">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/avatar.jpg" alt="" class="circle responsive-img activator card-profile-image">
                <a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right">
                    <i class="mdi-editor-mode-edit"></i>
                </a>

                <span class="card-title activator grey-text text-darken-4">{{item.name}}</span>
                <p><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> {{item.name}}</p>
                 <p><i class="mdi-social-cake cyan-text text-darken-2"></i> {{item.dob}}</p>
                <p><i class="mdi-communication-email cyan-text text-darken-2"></i>  {{item.gender}}</p>

            </div>
        </div>
    </div>

</div>

</div>

<script type="text/javascript">
    function GetDetailCtrl($scope, $http) {
        $scope.getDetail = function(id) {

            $http({
                method: 'POST',
                url: 'user/detail',
                data: $.param({id: id}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
            }).success(function(response) {
                $scope.info = response;
            }).error(function(response) {

            });
        };

    }
</script>