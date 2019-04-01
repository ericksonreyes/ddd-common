<?php

namespace DDDCommon\ValueObject;

use DDDCommon\Attributes\ValueObject;

/**
 * Class PersonName
 * @package DDDCommon\ValueObject
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class PersonName implements ValueObject
{
    /**
     * @var string
     */
    private $honorific;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $middleName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var
     */
    private $postNominals;

    /**
     * PersonName constructor.
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function firstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function lastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $middleName
     * @return PersonName
     */
    public function withMiddleName(string $middleName): self
    {
        if (trim($middleName) !== '') {
            $this->middleName = $middleName;
        }

        return $this->init();
    }

    /**
     * @return string|null
     */
    public function middleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @param string $honorific
     * @return PersonName
     */
    public function withHonorific(string $honorific): self
    {
        if (trim($honorific) !== '') {
            $this->honorific = $honorific;
        }

        return $this->init();
    }

    /**
     * @return string|null
     */
    public function honorific(): ?string
    {
        return $this->honorific;
    }

    /**
     * @param string $postNominals
     * @return PersonName
     */
    public function withPostNominals(string $postNominals): self
    {
        if (trim($postNominals) !== '') {
            $this->postNominals = $postNominals;
        }

        return $this->init();
    }

    /**
     * @return string|null
     */
    public function postNominals(): ?string
    {
        return $this->postNominals;
    }

    /**
     * @return PersonName
     */
    private function init(): self
    {
        $anotherName = new self($this->firstName, $this->lastName);

        $optionalFields = ['middleName', 'honorific', 'postNominals'];
        foreach ($optionalFields as $optionalField) {
            if ($this->$optionalField !== null) {
                $anotherName->$optionalField = $this->$optionalField;
            }
        }

        return $anotherName;
    }

    /**
     * @param PersonName $anotherPersonName
     * @return bool
     */
    public function matches(PersonName $anotherPersonName): bool
    {
        $fields = ['firstName', 'lastName', 'middleName', 'honorific', 'postNominals'];

        foreach ($fields as $field) {
            if ($anotherPersonName->$field() !== $this->$field()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'honorific' => $this->honorific,
            'firstName' => $this->firstName,
            'middleName' => $this->middleName,
            'lastName' => $this->lastName,
            'postNominals' => $this->postNominals
        ];
    }

    /**
     * @param PersonName $anotherPersonName
     * @return bool
     */
    public function doesNotMatch(PersonName $anotherPersonName): bool
    {
        return !$this->matches($anotherPersonName);
    }
}
