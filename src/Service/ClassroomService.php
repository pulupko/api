<?php
namespace App\Service;

use App\Entity\Classroom;
use App\Exception\BadDataException;
use App\Exception\NotFoundException;
use App\Validator\ClassroomValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\{RequestStack, Request};

class ClassroomService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Request
     */
    private $request;

    /**
     * ClassroomService constructor.
     * @param EntityManagerInterface $em
     * @param RequestStack $requestStack
     */
    public function __construct(EntityManagerInterface $em, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @throws BadDataException
     */
    public function addNewClassroom(): void
    {
        $body = json_decode($this->request->getContent(), true);

        if (
            true === is_null($body) ||
            false === ClassroomValidator::isNameValid($body['name'])
        ) {
            throw new BadDataException('Bad JSON or name must be a string with max length 60');
        }
        $classroom = new Classroom();
        $classroom->setName($body['name']);
        $classroom->setIsActive((bool)$body['is_active']);
        $this->em->persist($classroom);
        $this->em->flush();
    }

    /**
     * @param Classroom|null $classroom
     * @throws BadDataException
     * @throws NotFoundException
     */
    public function updateClassroom(?Classroom $classroom): void
    {
        $body = json_decode($this->request->getContent(), true);

        if(true === is_null($classroom)) {
            throw new NotFoundException('Not found');
        }

        if (
            true === is_null($body) ||
            false === ClassroomValidator::isNameValid($body['name'])
        ) {
            throw new BadDataException(
                'Bad JSON or name must be a string with max length 60'
            );
        }
        $classroom->setName($body['name']);
        $classroom->setIsActive((bool)$body['is_active']);
        $this->em->flush();
    }

    /**
     * @param Classroom|null $classroom
     * @throws NotFoundException
     */
    public function deleteClassroom(?Classroom $classroom): void
    {
        if(true === is_null($classroom)) {
            throw new NotFoundException('Not found');
        }
        $this->em->remove($classroom);
        $this->em->flush();
    }

    /**
     * @param Classroom|null $classroom
     * @throws NotFoundException
     */
    public function changeStatusClassroom(?Classroom $classroom): void
    {
        $body = json_decode($this->request->getContent(), true);
        if(true === is_null($classroom)) {
            throw new NotFoundException('Not found');
        }
        $classroom->setIsActive((bool)$body['is_active']);

        $this->em->flush();
    }
}
