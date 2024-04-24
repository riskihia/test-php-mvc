<?php

namespace EsbiTest\Repository;

use EsbiTest\Domain\User;

class UserRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findById(string $id): ?User
    {
        $statement = $this->connection->prepare("SELECT id, username,email, password FROM users WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->username = $row['username'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findByUsername(string $username): ?User
    {
        $statement = $this->connection->prepare("SELECT id, username,email, password FROM users WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->username = $row['username'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function update(User $user): User
    {
        $statement = $this->connection->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        $statement->execute([
            $user->username, $user->email, $user->password, $user->id
        ]);
        return $user;
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM users WHERE id = ?");
        $statement->execute([$id]);
    }
    
    public function findByEmail(string $email): ?User
    {
        $statement = $this->connection->prepare("SELECT id, username,email, password FROM users WHERE email = ?");
        $statement->execute([$email]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->username = $row['username'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function save(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO users( username,email, password) VALUES (?, ?, ?)");
        $statement->execute([$user->username, $user->email, $user->password
        ]);
        return $user;
    }
}