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
                            <h1 ng-if="showNumbers" ng-cloak>@{{ priorityNumbers.regular.pay_in }}</h1>
                        </button>
                    </div>
                    <div class="col-6 number-button">
                        <button type="button" class="btn btn-block btn-primary" ng-click="printPriorityNumber('regular','payout')">
                            <h1 ng-if="!showNumbers">PAYOUT</h1>
                            <h1 ng-if="showNumbers" ng-cloak>@{{ priorityNumbers.regular.payout }}</h1>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 number-button vip">
                        <button type="button" class="btn btn-block btn-primary" ng-click="printPriorityNumber('vip','pay in')">
                            <h1 ng-if="!showNumbers">VIP<br>PAY IN</h1>
                            <h1 ng-if="showNumbers" ng-cloak>@{{ priorityNumbers.vip.pay_in }}</h1>
                        </button>
                    </div>
                    <div class="col-6 number-button vip">
                        <button type="button" class="btn btn-block btn-primary" ng-click="printPriorityNumber('vip','payout')">
                            <h1 ng-if="!showNumbers">VIP<br>PAYOUT</h1>
                            <h1 ng-if="showNumbers" ng-cloak>@{{ priorityNumbers.vip.payout }}</h1>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 number-button">
                        <button type="button" class="btn btn-block btn-primary" ng-click="printPriorityNumber('senior_pwd','pay in')">
                            <h1 ng-if="!showNumbers">SENIOR/PWD<br>PAY IN</h1>
                            <h1 ng-if="showNumbers" ng-cloak>@{{ priorityNumbers.senior_pwd.pay_in }}</h1>
                        </button>
                    </div>
                    <div class="col-6 number-button">
                        <button type="button" class="btn btn-block btn-primary" ng-click="printPriorityNumber('senior_pwd','payout')">
                            <h1 ng-if="!showNumbers">SENIOR/PWD<br>PAYOUT</h1>
                            <h1 ng-if="showNumbers" ng-cloak>@{{ priorityNumbers.senior_pwd.payout }}</h1>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 number-button">
                        <button type="button" class="btn btn-block btn-danger" ng-click="printPriorityNumber('customer_service')">
                            <h1 ng-if="!showNumbers">CUSTOMER SERVICE</h1>
                            <h1 ng-if="showNumbers" ng-cloak>@{{ priorityNumbers.customer_service }}</h1>
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
                            <button type="button" class="btn btn-outline-warning" ng-click="resetNumbers()">
                                <h1>RESET NUMBERS</h1>
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
                window.open('/priority-number/?category=' + category + '&type=' + type,
                'newwindow',
                'width=500,height=600');
                return false;
            }, 150);

            $scope.hideNumbers = function() {
                $scope.showNumbers = false;
            }

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
