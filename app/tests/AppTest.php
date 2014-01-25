<?php

class AppTest extends TestCase {

	public function testAppWillStartup()
	{
		$crawler = $this->client->request('GET', '/');
		$this->assertEquals(count(User::get()), 1);
		$this->assertTrue($this->client->getResponse()->isOk());
	}

}