<div class="col s12 m12 l12" ng-app="" ng-controller="PharmacyController">
    <div class="col s12 m6 l6">
        <div class="row">
            <div class="col s12 m4 l4" ng-repeat="item in info.data">
                <div class="card  light-blue">
                    <div class="card-content white-text">
                        <span class="card-title">{{item.name}}</span>
                        <p>{{item.address}}</p>
                    </div>
                    <div class="card-action">
                        <a href="#" class="lime-text text-accent-1">This is a link</a>
                        <a href="#" class="lime-text text-accent-1">This is a link</a>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
<script type="text/javascript">
    function PharmacyController($scope, $http) {
        $http({
            method: 'GET',
            url: '<?php echo Yii::app()->createUrl('pharmacy/getPharmacy') ?>',
            params: {number: 10, offset: 2},
            headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
        }).success(function (response) {
            $scope.info = response;
        }).error(function (response) {

        });


    }


</script>