<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * UserRepository class
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{

    /**
     * Constructor
     *
     * @param ManagerRegistry $registry The manager registry.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Save a User entity
     *
     * @param User $user The user entity to save.
     *
     * @return void
     */

    public function save(User $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }


    /**
     * Upgrade password for a user
     *
     * This method is used to update the user's password. The new password should be hashed.
     *
     * @param PasswordAuthenticatedUserInterface $user The user whose password should be upgraded.
     * @param string $newHashedPassword The new hashed password.
     *
     * @throws UnsupportedUserException if the user is not an instance of the User entity.
     *
     * @return void
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}
