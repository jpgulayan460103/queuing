<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>


        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            .number-button{
                padding: 10px;
            }
            .number-button button{
                height: 15vh;
                overflow: hidden;
            }
            .btn-outline-warning:hover, .btn-outline-warning:active, .btn-outline-warning:visited{
                background: #BFAC12 !important;
            }
            .vip button, .vip button:active, .vip button:visited{
                background: #BFAC12 !important;
            }
            .vip button:hover{
                background:rgba(191,172,18,0.9) !important;
            }
            .number-button h1{
                padding: 5px;
                color: #ffffff;
            }
            body{
                background: #222933;
                font-family: "Tahoma";
            }
            [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
                display: none !important;
            }

            @media (max-width: 575.98px) {
                .number-button h1{
                    font-size: 14px;
                    padding: 1px;
                }
                .number-button{
                    padding: 5px;
                }
            }

            @media (max-width: 767.98px) {
                .number-button h1{
                    font-size: 18px;
                    padding: 1px;
                }
                .number-button{
                    padding: 5px;
                }
            }

            @media (max-width: 991.98px) {
                .number-button h1{
                    font-size: 18px;
                    padding: 1px;
                }
                .number-button{
                    padding: 5px;
                }
            }

            @media (max-width: 1199.98px) {

            }
        </style>
    </head>
    <body>
        <div id="app" ng-app="main">
            <div class="container" ng-controller="myCtrl">
                <div class="row">
                    <div class="col-12">
                        <img src="img/logo.png" alt="" class="mx-auto d-block">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 number-button">
                        <button type="button" class="btn btn-block btn-primary" ng-click="printPriorityNumber('regular','pay in')">
                            <h1 ng-if="!showNumbers">PAY IN</h1>
                            <h1 ng-if="showNumbers && !editNumbers" ng-cloak>@{{ priorityNumbers.regular.pay_in }}</h1>
                            <input type="text" ng-if="showNumbers && editNumbers" ng-model="priorityNumbers.regular.pay_in" ng-cloak>
                        </button>
                    </div>
                    <div class="col-6 number-button">
                        <button type="button" class="btn btn-block btn-primary" ng-click="printPriorityNumber('regular','payout')">
                            <h1 ng-if="!showNumbers">PAYOUT</h1>
                            <h1 ng-if="showNumbers && !editNumbers" ng-cloak>@{{ priorityNumbers.regular.payout }}</h1>
                            <input type="text" ng-if="showNumbers && editNumbers" ng-model="priorityNumbers.regular.payout" ng-cloak>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 number-button vip">
                        <button type="button" class="btn btn-block btn-primary" ng-click="printPriorityNumber('vip','pay in')">
                            <h1 ng-if="!showNumbers">VIP<br>PAY IN</h1>
                            <h1 ng-if="showNumbers && !editNumbers" ng-cloak>@{{ priorityNumbers.vip.pay_in }}</h1>
                            <input type="text" ng-if="showNumbers && editNumbers" ng-model="priorityNumbers.vip.pay_in" ng-cloak>
                        </button>
                    </div>
                    <div class="col-6 number-button vip">
                        <button type="button" class="btn btn-block btn-primary" ng-click="printPriorityNumber('vip','payout')">
                            <h1 ng-if="!showNumbers">VIP<br>PAYOUT</h1>
                            <h1 ng-if="showNumbers && !editNumbers" ng-cloak>@{{ priorityNumbers.vip.payout }}</h1>
                            <input type="text" ng-if="showNumbers && editNumbers" ng-model="priorityNumbers.vip.payout" ng-cloak>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 number-button">
                        <button type="button" class="btn btn-block btn-primary" ng-click="printPriorityNumber('senior_pwd','pay in')">
                            <h1 ng-if="!showNumbers">SENIOR/PWD<br>PAY IN</h1>
                            <h1 ng-if="showNumbers && !editNumbers" ng-cloak>@{{ priorityNumbers.senior_pwd.pay_in }}</h1>
                            <input type="text" ng-if="showNumbers && editNumbers" ng-model="priorityNumbers.senior_pwd.pay_in" ng-cloak>
                        </button>
                    </div>
                    <div class="col-6 number-button">
                        <button type="button" class="btn btn-block btn-primary" ng-click="printPriorityNumber('senior_pwd','payout')">
                            <h1 ng-if="!showNumbers">SENIOR/PWD<br>PAYOUT</h1>
                            <h1 ng-if="showNumbers && !editNumbers" ng-cloak>@{{ priorityNumbers.senior_pwd.payout }}</h1>
                            <input type="text" ng-if="showNumbers && editNumbers" ng-model="priorityNumbers.senior_pwd.payout" ng-cloak>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 number-button">
                        <button type="button" class="btn btn-block btn-danger" ng-click="printPriorityNumber('customer_service')">
                            <h1 ng-if="!showNumbers">CUSTOMER SERVICE</h1>
                            <h1 ng-if="showNumbers && !editNumbers" ng-cloak>@{{ priorityNumbers.customer_service }}</h1>
                            <input type="text" ng-if="showNumbers && editNumbers" ng-model="priorityNumbers.customer_service" ng-cloak>
                        </button>
                    </div>
                    <div class="col-6 number-button">
                        <div class="btn-group btn-block" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-warning" ng-click="viewNumbers()" ng-if="!showNumbers">
                                <h1>VIEW NUMBERS</h1>
                            </button>
                            <button type="button" class="btn btn-outline-warning" ng-click="hideNumbers()" ng-if="showNumbers" ng-cloak>
                                <h1>HIDE NUMBERS</h1>
                            </button>
                            <button type="button" class="btn btn-outline-warning" ng-click="resetNumbers()" ng-if="!editNumbers">
                                <h1>RESET NUMBERS</h1>
                            </button>
                            <button type="button" class="btn btn-success" ng-click="saveNumbers()" ng-if="editNumbers" ng-cloak>
                                <h1>SAVE NUMBERS</h1>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
        app.controller('myCtrl', function($scope, $http, $sce, $window) {
            $scope.showVipButton = false;
            $scope.showNumbers = false;
            $scope.priorityNumbers = {};
            $scope.showVipPayOption = _.debounce(function(data) {
                $scope.$apply(function() {
                    $scope.showVipButton = true;
                });
            }, 300);

            $scope.printPriorityNumber = _.debounce(function (category, type) {
                if($scope.editNumbers || $scope.showNumbers){
                    return false;
                }
                window.open('/priority-number/?category=' + category + '&type=' + type,
                'newwindow',
                'width=500,height=600');
                return false;
            }, 150);

            $scope.hideNumbers = function() {
                $scope.showNumbers = false;
                $scope.editNumbers = false;
            }

            $scope.resetNumbers = _.debounce(function() {
                $http({
                    method: 'GET',
                    url: '/current-numbers',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function (response) {
                    $scope.showNumbers = true;
                    $scope.editNumbers = true;
                    $scope.priorityNumbers = response.data;
                    console.log($scope.priorityNumbers );
                }, function (rejection) {
                    if (rejection.status != 422) {
                        request_error(rejection.status);
                    } else if (rejection.status == 422) {
                        var errors = rejection.data;
                        $scope.formerrors = errors;
                    }
                    $scope.submit = false;
                });
            }, 150);


            $scope.saveNumbers = _.debounce(function() {
                $http({
                    method: 'POST',
                    url: '/current-numbers',
                    data: $.param($scope.priorityNumbers),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function (response) {
                    $scope.showNumbers = true;
                    $scope.editNumbers = false;
                }, function (rejection) {
                    if (rejection.status != 422) {
                    } else if (rejection.status == 422) {
                        alert('Must Enter a Number');
                    }
                    $scope.submit = false;
                });
            }, 150);

            $scope.viewNumbers = _.debounce(function() {
                $http({
                    method: 'GET',
                    url: '/current-numbers',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function (response) {
                    $scope.showNumbers = true;
                    $scope.priorityNumbers = response.data;
                    console.log($scope.priorityNumbers );
                }, function (rejection) {
                    if (rejection.status != 422) {
                        request_error(rejection.status);
                    } else if (rejection.status == 422) {
                        var errors = rejection.data;
                        $scope.formerrors = errors;
                    }
                    $scope.submit = false;
                });
            }, 150);


        });
        </script>
    </body>
</html>
