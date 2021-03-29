<?php
namespace App\DataProvider;

use App\Entity\Classroom;
use App\Repository\ClassroomRepository;

class ClassroomDataProvider
{
    /**
     * @var ClassroomRepository
     */
    private $classroomRepository;

    /**
     * ClassroomDataProvider constructor.
     * @param ClassroomRepository $classroomRepository
     */
    public function __construct(ClassroomRepository $classroomRepository)
    {
        $this->classroomRepository = $classroomRepository;
    }

    /**
     * @return Classroom[]
     */
    public function getAll(): array
    {
        return $this->classroomRepository->findAll();
    }

    /**
     * @param int $id
     * @return Classroom|null
     */
    public function getOne(int $id): ?Classroom
    {
        return $this->classroomRepository->findOneBy(['id' => $id]);
    }
}
