<?php

namespace Tests\Package\User\Domain;

use App\Package\User\Domain\User;
use App\Package\User\DTO\UserDto;
use App\Package\User\Exception\EmptyPasswordException;
use App\Package\User\Exception\EmptyUsernameException;
use App\Package\User\Exception\InvalidPasswordException;
use DateTime;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCriarNovoUsuario(): void
    {
        $user = new User();

        $this->assertNull($user->getId());
        $this->assertNull($user->getCreateTimestamp());
        $this->assertFalse($user->isActive());
    }

    /**
     * @throws EmptyPasswordException
     */
    public function testUsuarioSemUsername(): void
    {
        $user = new User();

        $this->expectException(EmptyUsernameException::class);

        $user->validate();
    }

    /**
     * @throws EmptyUsernameException
     */
    public function testUsuarioSemSenha(): void
    {
        $date = new DateTime('2020-01-01');
        $data = new UserDto(
            1,
            $date,
            null,
            null,
            'user@email.com',
            null
        );

        $user = new User();
        $user->map($data);

        $this->expectException(EmptyPasswordException::class);

        $user->validate();
    }

    public function testMapearUsuario(): void
    {
        $date = new DateTime('2020-01-01');
        $data = new UserDto(
            1,
            $date,
            null,
            null,
            'user@email.com',
            password_hash('user', PASSWORD_DEFAULT)
        );

        $user = new User();
        $user->map($data);

        $this->assertEquals(1, $user->getId());
        $this->assertEquals($date, $user->getCreateTimestamp());
        $this->assertTrue($user->isActive());
        $this->assertNull($user->getUpdateTimestamp());
    }

    public function testInativarUsuario(): void
    {
        $date = new DateTime('2020-01-01');
        $data = new UserDto(
            1,
            $date,
            null,
            null,
            'user@email.com',
            password_hash('user', PASSWORD_DEFAULT)
        );

        $user = new User();
        $user->map($data);
        $user->inactivate();

        $this->assertFalse($user->isActive());
    }

    /**
     * @throws InvalidPasswordException
     */
    public function testAlterarSenha(): void
    {
        $date = new DateTime('2020-01-01');
        $data = new UserDto(
            1,
            $date,
            null,
            null,
            'user@email.com',
            password_hash('user', PASSWORD_DEFAULT)
        );

        $user = new User();
        $user->map($data);

        $user->changePassword('user', '12345678');

        $this->assertTrue($user->checkPassword('12345678'));
    }

    public function testTentarAlterarSenhaComSenhaAnteriorIncorreta(): void
    {
        $date = new DateTime('2020-01-01');
        $data = new UserDto(
            1,
            $date,
            null,
            null,
            'user@email.com',
            password_hash('user', PASSWORD_DEFAULT)
        );

        $user = new User();
        $user->map($data);

        $this->expectException(InvalidPasswordException::class);
        $user->changePassword('123', '12345678');
    }

    public function testDesativarUsuario(): void
    {
        $date = new DateTime('2020-01-01');
        $data = new UserDto(
            1,
            $date,
            null,
            null,
            'user@email.com',
            password_hash('user', PASSWORD_DEFAULT)
        );

        $user = new User();
        $user->map($data);
        $user->inactivate();

        $this->assertFalse($user->isActive());
    }
}
