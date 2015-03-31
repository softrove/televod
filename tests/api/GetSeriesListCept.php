<?php 
$I = new ApiTester($scenario);
$I->wantTo('Get the list of series');
$I->sendGET('series');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson(["success" => true]);

