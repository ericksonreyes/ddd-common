<?php

namespace spec\DDDCommon\ValueObject;

use DDDCommon\Attributes\IsString;
use DDDCommon\Attributes\ValueObject;
use DDDCommon\ValueObject\Exception\InvalidEmailException;
use spec\DDDCommon\UnitTestTrait;
use DDDCommon\ValueObject\Email;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmailSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var string
     */
    private $email;

    public function let()
    {
        $this->beConstructedWith($this->email = $this->seeder->email);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Email::class);
        $this->shouldHaveType(ValueObject::class);
    }

    public function it_only_accepts_valid_emails()
    {
        $this->shouldThrow(InvalidEmailException::class)->during('__construct', [
            $this->seeder->word
        ]);
    }

    public function it_does_not_accept_empty_strings()
    {
        $this->shouldThrow(InvalidEmailException::class)->during('__construct', [
            str_repeat(' ', mt_rand(1, 10))
        ]);
    }

    public function it_can_be_converted_to_string()
    {
        $this->__toString()->shouldReturn($this->email);
    }

    public function it_has_an_array_representation()
    {
        $this->toArray()->shouldReturn([
            'value' => $this->email
        ]);
    }

    public function it_can_be_matched(Email $sameEmail)
    {
        $sameEmail->value()->shouldBeCalled()->willReturn($this->email);
        $this->matches($sameEmail)->shouldReturn(true);
        $this->doesNotMatch($sameEmail)->shouldReturn(false);
    }

    public function it_can_be_mismatched(Email $aDifferentEmail)
    {
        $aDifferentEmail->value()->shouldBeCalled()->willReturn($this->seeder->email);
        $this->matches($aDifferentEmail)->shouldReturn(false);
        $this->doesNotMatch($aDifferentEmail)->shouldReturn(true);
    }
}
