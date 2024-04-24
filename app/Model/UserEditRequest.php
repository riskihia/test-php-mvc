<?php

namespace EsbiTest\Model;

class UserEditRequest
{
    public ?string $id = null;
    public ?string $oldUsername = null;
    public ?string $oldEmail = null;
    public ?string $newPassword = null;
    public ?string $oldPassword = null;
}