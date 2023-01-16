<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BookController extends AbstractController
{
    #[Route('api/books', name: 'bookAll', methods: ['GET'])]
    public function getBooks(BookRepository $bookRepository, SerializerInterface $serializer): JsonResponse
    {
        $books = $bookRepository->findAll();
        $jsonBooks = $serializer->serialize($books, 'json', ['groups' => 'getBooks']);
        return new JsonResponse($jsonBooks, Response::HTTP_OK, [], true);
    }

    #[Route('api/books/{id}', name: 'bookDetails', methods: ['GET'])]
    public function getDetailBook(Book $book, SerializerInterface $serializer)
    {
        $jsonBook = $serializer->serialize($book, 'json', ['groups' => 'getBooks']);
        return new JsonResponse($jsonBook, Response::HTTP_OK, [], true);
    }
}
