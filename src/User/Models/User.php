<?php

namespace Meirelles\BackendBrCryptography\User\Models;

use Meirelles\BackendBrCryptography\Core\Model;
use Meirelles\BackendBrCryptography\User\Services\SensitiveDataService;

class User extends Model
{
    protected readonly int $id;
    protected string $userDocument;
    protected string $creditCardToken;

    public function __construct(
        string $userDocument,
        string $creditCardToken,
        protected int $value,
    )
    {
        $this->setUserDocument($userDocument);
        $this->setCreditCardToken($creditCardToken);

        parent::__construct();
    }

    public function getUserDocument(): string
    {
        $sensitiveDataService = new SensitiveDataService();

        return $sensitiveDataService->decrypt($this->userDocument);
    }

    public function setUserDocument(string $userDocument): User
    {
        $sensitiveDataService = new SensitiveDataService();

        $this->userDocument = $sensitiveDataService->encrypt($userDocument);

        return $this;
    }

    public function getCreditCardToken(): string
    {
        $sensitiveDataService = new SensitiveDataService();

        return $sensitiveDataService->decrypt($this->creditCardToken);
    }

    public function setCreditCardToken(string $creditCardToken): User
    {
        $sensitiveDataService = new SensitiveDataService();

        $this->creditCardToken = $sensitiveDataService->encrypt($creditCardToken);
        return $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): User
    {
        $this->value = $value;
        return $this;
    }
}