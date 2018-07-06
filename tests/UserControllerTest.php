<?php


use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\UserController;
use Symfony\Component\HttpFoundation\JsonResponse;


class UserControllerTest extends TestCase
{
    public function testUserAction()
    {
        $response = '{"pseudo":null,"registration":null,"comments":[]}';

        $mockEntityManagerInterface = $this->createMock(EntityManagerInterface::class);

        $mockRepository = $this->createMock(\Doctrine\Common\Persistence\ObjectRepository::class);

        $mockEntityManagerInterface
            ->expects($this->once())
            ->method('getRepository')
            ->willReturn($mockRepository);

        $mockRepository
            ->expects($this->once())
            ->method('findOneBy')
            ->willReturn( new \App\Entity\User());


        $obj = new UserController($mockEntityManagerInterface);

       $content = $obj->userAction(1)->getContent();

       $this->assertEquals($response, $content);


    }


}