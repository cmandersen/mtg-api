<?php
$I = new TestGuy($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage("/api/v1/cards");
$I->seeResponseIsJson();