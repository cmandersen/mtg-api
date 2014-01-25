<?php

class AppTest extends TestCase {

	public function testAppWillStartup()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

}