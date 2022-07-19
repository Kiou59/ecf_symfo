<?php

namespace App\DataFixtures;
use App\Entity\Auteur;
use App\Entity\Book;
use App\Entity\Emprunt;
use App\Entity\Emprunteur;
use App\Entity\Genre;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;

class AppFixturesTest extends Fixture
{
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');
        

        $this->loadUser($manager, $faker);
        // $this->loadGenre($manager, $faker);
        // $this->loadEmprunteur($manager, $faker);
        // $this->loadEmprunt($manager,$faker);
        // $this->loadBook($manager,$faker);
        // $this->loadAuteur($manager,$faker);
        $manager->flush();
    }
    public function loadUser(ObjectManager $manager, FakerGenerator $faker): void
    {
        $repository = $this->doctrine->getRepository(User::class);
        $categories = $repository->findAll();

        $userDatas=[
            [
                'email'=>'admin@example.com ',
                'roles'=>' ["ROLE_ADMIN"] ',
                'password'=>'$2y$10$/H2ChUxriH.0Q33g3EUEx.S2s4j/rGJH2G88jK9nCP60GbUW8mi5K',
                'enable'=> true,
                'created_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20200101 09:00:00'),
                'updated_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20200101 09:00:00'),

            ],
            [
                'email'=>'foo.foo@example.com  ',
                'roles'=>'["ROLE_EMRUNTEUR"]',
                'password'=>'$2y$10$/H2ChUxriH.0Q33g3EUEx.S2s4j/rGJH2G88jK9nCP60GbUW8mi5K',
                'enable'=> true,
                'created_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),
                'updated_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),

            ],
            [
                'email'=>'bar.bar@example.com ',
                'roles'=>'["ROLE_EMRUNTEUR"]',
                'password'=>'$2y$10$/H2ChUxriH.0Q33g3EUEx.S2s4j/rGJH2G88jK9nCP60GbUW8mi5K',
                'enable'=> false,
                'created_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),
                'updated_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),

            ],
            [
                'email'=>'baz.baz@example.com ',
                'roles'=>'["ROLE_EMRUNTEUR"]',
                'password'=>'$2y$10$/H2ChUxriH.0Q33g3EUEx.S2s4j/rGJH2G88jK9nCP60GbUW8mi5K',
                'enable'=> true,
                'created_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),
                'updated_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),

            ]
        ];

        foreach($userDatas as $userData){
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setRoles($userData['roles']);
            $user->setPassword($userData['password']);
            $user->setEnabled($userData['enable']);
            $user->setCreatedAt($userData['created_at']);
            $user->setUpdatedAt($userData['updated_at']);
            $manager->persist($user);
        }
        $manager->flush();
    }

}
