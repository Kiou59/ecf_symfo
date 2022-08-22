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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixturesTest extends Fixture
{
    public function __construct(ManagerRegistry $doctrine, UserPasswordEncoderInterface $encoder )
    {
        $this->doctrine = $doctrine;
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');
        

        $this->loadUser($manager, $faker);
        $this->loadGenre($manager, $faker);
        $this->loadEmprunteur($manager, $faker);

         $this->loadAuteur($manager,$faker);
         $this->loadBook($manager,$faker);
         $this->loadEmprunt($manager,$faker);
       
    }
    public function loadUser(ObjectManager $manager, FakerGenerator $faker): void
    {
        

        $userDatas=[
            [
                'email'=>'admin@example.com ',
                'roles'=> ["ROLE_ADMIN"] ,
                'password'=>'$2y$10$/H2ChUxriH.0Q33g3EUEx.S2s4j/rGJH2G88jK9nCP60GbUW8mi5K',
                'enable'=> TRUE,
                'created_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20200101 09:00:00'),
                'updated_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20200101 09:00:00'),

            ],
            [
                'email'=>'foo.foo@example.com  ',
                'roles'=>["ROLE_EMPRUNTEUR"],
                'password'=>'$2y$10$/H2ChUxriH.0Q33g3EUEx.S2s4j/rGJH2G88jK9nCP60GbUW8mi5K',
                'enable'=> TRUE,
                'created_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),
                'updated_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),

            ],
            [
                'email'=>'bar.bar@example.com ',
                'roles'=>["ROLE_EMPRUNTEUR"],
                'password'=>'$2y$10$/H2ChUxriH.0Q33g3EUEx.S2s4j/rGJH2G88jK9nCP60GbUW8mi5K',
                'enable'=> FALSE,
                'created_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),
                'updated_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),

            ],
            [
                'email'=>'baz.baz@example.com ',
                'roles'=>["ROLE_EMPRUNTEUR"],
                'password'=>'$2y$10$/H2ChUxriH.0Q33g3EUEx.S2s4j/rGJH2G88jK9nCP60GbUW8mi5K',
                'enable'=> TRUE,
                'created_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),
                'updated_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),

            ]
        ];

        foreach($userDatas as $userData){
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setRoles($userData['roles']);
            $user->setPassword($userData['password']);
            $user->setEnable($userData['enable']);
            $user->setCreatedAt($userData['created_at']);
            $user->setUpdatedAt($userData['updated_at']);
            $manager->persist($user);
        }
        for($i=0; $i <100; $i++){
            
            $user = new User();
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_EMPRUNTEUR']);
            $password = $this->encoder->encodePassword($user, '123');
            $user->setPassword($password);
            $user->setEnable($faker->boolean());
            $date = $faker->dateTimeBetween('-6 month', '+6 month');
            $date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', "2022-{$date->format('m-d H:i:s')}");

            $user->setCreatedAt($date);
            $date = $faker->dateTimeBetween('-6 month', '+6 month');
            $date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', "2022-{$date->format('m-d H:i:s')}");

            $user->setUpdatedAt($date);

            $manager->persist($user);

        }
        $manager->flush();
    }
    public function loadEmprunteur(ObjectManager $manager, FakerGenerator $faker): void
    {
        $repository = $this->doctrine->getRepository(User::class);
        $users = $repository->findAll();
    
        $emprunteurDatas =[
            [
                "nom"=>'foo',
                "prenom"=>'foo',
                'tel'=>'123456789',
                'actif'=>true,
                'created_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),
                'updated_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),
                "user_id"=>$users[1]
            ],[
                "nom"=>'bar',
                "prenom"=>'bar',
                'tel'=>'123456789',
                'actif'=>true,
                'created_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),
                'updated_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),
                "user_id"=>$users[2]
            ],[
                "nom"=>'baz',
                "prenom"=>'baz',
                'tel'=>'123456789',
                'actif'=>true,
                'created_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),
                'updated_at'=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20220701 09:00:00'),
                "user_id"=>$users[3]
            ]
            ];
    foreach($emprunteurDatas as $emprunteurData){
        $emprunteur=new Emprunteur();
        $emprunteur->setNom($emprunteurData["nom"]);
        $emprunteur->setPrenom($emprunteurData["prenom"]);
        $emprunteur->setTel($emprunteurData["tel"]);
        $emprunteur->setActif($emprunteurData['actif']);
        $emprunteur->setCreatedAt($emprunteurData['created_at']);
        $emprunteur->setUpdatedAt($emprunteurData['updated_at']);
        $emprunteur->setUser($emprunteurData['user_id']);
        $manager->persist($emprunteur);
    };
    for($i=4; $i<104; $i ++){
        $emprunteur=new Emprunteur();
        $emprunteur->setNom($faker->lastName());
        $emprunteur->setPrenom($faker->firstName());
        $emprunteur->setTel($faker->phoneNumber());
        $date = $faker->dateTimeBetween('-6 month', '+6 month');
        $date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', "2022-{$date->format('m-d H:i:s')}");
        $emprunteur->setCreatedAt($date);

        $emprunteur->setUpdatedAt($date);
        $emprunteur->setActif($faker->boolean());
        $emprunteur->setUser($users[$i]);
        $manager->persist($emprunteur);

    };
    $manager->flush();
    }public function loadAuteur(ObjectManager $manager,FakerGenerator $faker):void{

        $auteurDatas=[
            ['nom'=>'auteur inconnu',
            'prenom'=>''],
            ['nom'=>'Cartier',
            'prenom'=>'Hugues'],
            ['nom'=>'Lambert',
            'prenom'=>'Armand'],
            ['nom'=>'Moitessier',
            'prenom'=>'Thomas']
        ];
        foreach($auteurDatas as $auteurData){
            $auteur=new Auteur();
            $auteur->setNom($auteurData['nom']);
            $auteur->setPrenom($auteurData['prenom']);
            $manager->persist($auteur);
        }
        for($i=0 ;$i<500;$i ++){
            $auteur= new Auteur();
            $auteur->setNom($faker->lastName());
            $auteur->setPrenom($faker->firstName());
            $manager->persist($auteur);
        }
        $manager->flush();
    }
    public function loadGenre(ObjectManager $manager,FakerGenerator $faker):void{
        $genreDatas=[
            ['nom'=>'poésie',
            'description'=>NULL],
            ['nom'=>'nouvelle',
            'description'=>NULL],
            ['nom'=>'roman historique',
            'description'=>NULL],
            ['nom'=>"roman d'amour",
            'description'=>NULL],
            ['nom'=>"roman d'aventure",
            'description'=>NULL],
            ['nom'=>"science-fiction",
            'description'=>NULL],
            ['nom'=>"fantasy",
            'description'=>NULL],
            ['nom'=>"biographie",
            'description'=>NULL],
            ['nom'=>"conte",
            'description'=>NULL],
            ['nom'=>"témoignage",
            'description'=>NULL],
            ['nom'=>"théâtre",
            'description'=>NULL],
            ['nom'=>"essaie",
            'description'=>NULL],
            ['nom'=>"journal intime",
            'description'=>NULL]
        ];
        foreach($genreDatas as $genreData){
            $genre=new Genre();
            $genre->setNom($genreData['nom']);
            $genre->setDescription($genreData['description']);
            $manager->persist($genre);
        }$manager->flush();
    }
     public function loadBook(ObjectManager $manager, FakerGenerator $faker): void
    {
        $repositoryAuteur = $this->doctrine->getRepository(Auteur::class);
        $auteurs = $repositoryAuteur->findAll();
        $repositoryGenre = $this->doctrine->getRepository(Genre::class);
        $genres = $repositoryGenre->findAll();

        $bookDatas=[
        ['titre'=>"Lorem ipsum dolor sit amet",
        'annee_edition'=>2010,
        'nombre_pages'=>100,
        'code_isbn'=>'9785786930024',
        'auteur'=> $auteurs[0],
        'genre_id'=>$genres[0],
        ],
        ['titre'=>"Consectetur adipiscing elit ",
        'annee_edition'=>2011,
        'nombre_pages'=>150,
        'code_isbn'=>'9783817260935',
        'auteur'=>$auteurs[1],
        'genre_id'=>$genres[1]
    ],['titre'=>"Mihi quidem Antiochum",
    'annee_edition'=>2012,
    'nombre_pages'=>200,
    'code_isbn'=>'9782020493727',
    'auteur'=>$auteurs[2],
    'genre_id'=>$genres[2]
],['titre'=>"Quem audis satis belle ",
'annee_edition'=>2013,
'nombre_pages'=>250,
'code_isbn'=>'9794059561353',
'auteur'=>$auteurs[3],
'genre_id'=>$genres[3]
]];
foreach($bookDatas as $bookData){
    $book=new Book();
    $book->setTitle($bookData['titre']);
    $book->setAnneeEdition($bookData['annee_edition']);
    $book->setNombrePages($bookData['nombre_pages']);
    $book->setCodeIsbn($bookData['code_isbn']);
    $book->setAuteur($bookData['auteur']);
    $book->addGenre($bookData['genre_id']);
    $manager->persist($book);
}
for($i=0; $i<1000; $i ++){
    $book= new Book();
    $book->setTitle($faker->words(3,true));
    $book->setAnneeEdition($faker->numberBetween(1500,2022));
    $book->setNombrePages($faker->numberBetween(50,1500));
    $book->setAuteur($auteurs[$faker->numberBetween(0,500)]);
    $book->addGenre($genres[$faker->numberBetween(0,12)]);
    $book->setCodeIsbn($faker->isbn13());
    $manager->persist($book);


};
$manager->flush();
    }
    
    public function loadEmprunt(ObjectManager $manager, FakerGenerator $faker): void
    {
        $repository = $this->doctrine->getRepository(Emprunteur::class);
        $emprunteurs = $repository->findAll();
        $repository = $this->doctrine->getRepository(Book::class);
        $books = $repository->findAll();
        
        $empruntDatas=[
            ["date_emprunt"=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20200201 10:00:00'),
            "date_retour"=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20200301 10:00:00'),
            "emprunteur_id"=>$emprunteurs[0],
            "book_id"=>$books[0]],[
                "date_emprunt"=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20200201 10:00:00'),
            "date_retour"=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20200301 10:00:00'),
            "emprunteur_id"=>$emprunteurs[1],
            "book_id"=>$books[1]
            ],[
                "date_emprunt"=>DateTimeImmutable::createFromFormat('Ymd H:i:s', '20200201 10:00:00'),
            "date_retour"=>null,
            "emprunteur_id"=>$emprunteurs[2],
            "book_id"=>$books[2]
            ]];

        foreach($empruntDatas as $empruntData){
            $emprunt = new Emprunt();
            $emprunt->setDateEmprunt($empruntData["date_emprunt"]);
            $emprunt->setDateRetour($empruntData["date_retour"]);
            $emprunt->setEmprunteur($empruntData["emprunteur_id"]);
            $emprunt->setBook($empruntData["book_id"]);
            $manager->persist($emprunt);
        }
        for($i=0;$i<200; $i++){
            $emprunt=new Emprunt();
            $date = $faker->dateTimeBetween('-6 month', '+6 month');
            $date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', "2022-{$date->format('m-d H:i:s')}");
            $emprunt->setDateEmprunt($date);
            $date = $faker->dateTimeBetween('-6 month', '+6 month');
            $date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', "2022-{$date->format('m-d H:i:s')}");
            $emprunt->setDateRetour($date);
            $emprunt->setEmprunteur($emprunteurs[$faker->numberBetween(0,102)]);
            $emprunt->setBook($books[$faker->numberBetween(0,1000)]);
            $manager->persist($emprunt);
        }
        $manager->flush();
    }
}
