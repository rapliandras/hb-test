<?php

namespace App\Controller;

use App\Entity\Quote;
use App\Entity\User;
use App\Service\QuoteNormalizerService;
use App\Service\SimpsonsQuoteFetcherFactory;
use App\Service\SimpsonsQuoteFetcherService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[Route('/')]
class DefaultController extends AbstractController
{
    #[Route('/')]
    public function homepageAction(#[CurrentUser] ?User $user): Response
    {
        return $this->render('index.html.twig', ['userEmail' => $user->getEmail()]);
    }

    /**
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    #[Route('/quotes')]
    public function quotesAction(#[CurrentUser] ?User        $user,
                                 SimpsonsQuoteFetcherFactory $simpsonsFactory,
                                 EntityManagerInterface      $entityManager,
                                 NormalizerInterface         $normalizer): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => 'You need to be logged in first.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $this->removeEarliestQuoteFromDb($entityManager);

        $this->populateDbWithNewQuotes($entityManager, $simpsonsFactory);

        $quotes = $normalizer->normalize($this->getFiveQuotesFromDb($entityManager));

        return $this->render('quotes.html.twig', ['quotes' => $quotes]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return void
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function removeEarliestQuoteFromDb(EntityManagerInterface $entityManager): void
    {
        $earliestOne = $entityManager->getRepository(Quote::class)
            ->createQueryBuilder("e")
            ->orderBy("e.id", "ASC")
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        if ($earliestOne instanceof Quote) {
            $entityManager->remove($earliestOne);
            $entityManager->flush();
        }
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param SimpsonsQuoteFetcherFactory $simpsonsFactory
     * @return float|int|mixed|string
     */
    protected function populateDbWithNewQuotes(EntityManagerInterface $entityManager, SimpsonsQuoteFetcherFactory $simpsonsFactory): mixed
    {
        $fourFromTheDb = $entityManager->getRepository(Quote::class)
            ->createQueryBuilder("e")
            ->orderBy("e.id", "DESC")
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();

        if (count($fourFromTheDb) < 4) {
            $newQuotes = $simpsonsFactory->create('fake')->fetch(count($fourFromTheDb));
            foreach ($newQuotes as $newQuote) {
                $q = new Quote();
                $q->setQuote($newQuote['quote']);
                $entityManager->persist($q);
            }
            $entityManager->flush();
        }
        return $fourFromTheDb;
    }


    protected function getFiveQuotesFromDb(EntityManagerInterface $entityManager): mixed
    {
        return $entityManager->getRepository(Quote::class)
            ->createQueryBuilder("e")
            ->orderBy("e.id", "DESC")
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
}