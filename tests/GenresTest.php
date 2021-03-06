<?php

use ApiTmdb\Model\Genre;
use ApiTmdb\ApiTmdb;
use PHPUnit\Framework\TestCase;
use ApiTmdb\Model\TvShow\TvShow;
class GenresTest extends TestCase
{
    public function getApiKey(){
        return trim(file_get_contents('tests/apiKeyTmdb.txt'));
    }

    public function testsSetGenres(){
         $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
         $genres = $api->getGenresTvShow(false);
         $this->assertInstanceOf(Genre::class, $genres->getAll()[0]);
    }

    public function testGetGenresFromIdTv(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getTvShowById(1399);

        $firstResult = $result->getGenres()->get(0)->getName();
        $this->assertEquals($firstResult, 'Sci-Fi & Fantasy');
    }

    public function testGetOrderByAsc(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getTvShowById(1399);

        $firstResult = $result->getGenres()->orderById()->get(0);
        $this->assertEquals(18, $firstResult->getId());
    }

    public function testGetOrderByDesc(){
        $api = new \ApiTmdb\ApiTmdb($this->getApiKey());
        $result = $api->getTvShowById(1399);

        $firstResult = $result->getGenres()->orderById(false)->get(0);
        $this->assertEquals(10765, $firstResult->getId());
    }
}
