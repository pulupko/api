<?php
namespace App\Controller;

use App\DataProvider\ClassroomDataProvider;
use App\Exception\ApiException;
use App\Exception\BadDataException;
use App\Exception\NotFoundException;
use App\Service\ClassroomService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClassroomController extends BaseController
{
    /**
     * @param ClassroomDataProvider $classroomDataProvider
     * @return JsonResponse
     */
    public function list(ClassroomDataProvider $classroomDataProvider) :JsonResponse
    {
        try {
            $classrooms = $classroomDataProvider->getAll();
            return $this->successResponse(['classrooms' => $classrooms]);
        } catch (ApiException  $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * @param int $classroom
     * @param ClassroomDataProvider $classroomDataProvider
     * @return JsonResponse
     */
    public function show(int $classroom, ClassroomDataProvider $classroomDataProvider) :JsonResponse
    {
        try {
            $classroom = $classroomDataProvider->getOne($classroom);
            if(true === is_null($classroom)) {
                throw new NotFoundHttpException('Not found');
            }
            return $this->successResponse(['classroom' => $classroom]);
        } catch (NotFoundHttpException $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * @param ClassroomService $classroomService
     * @return JsonResponse
     */
    public function create(ClassroomService $classroomService) :JsonResponse
    {
        try {
            $classroomService->addNewClassroom();
            return $this->successResponse();
        } catch (BadDataException $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * @param int $classroom
     * @param ClassroomDataProvider $classroomDataProvider
     * @param ClassroomService $classroomService
     * @return JsonResponse
     */
    public function update(
        int $classroom,
        ClassroomDataProvider $classroomDataProvider,
        ClassroomService $classroomService
    ) :JsonResponse
    {

        try {
            $classroom = $classroomDataProvider->getOne($classroom);
            $classroomService->updateClassroom($classroom);

            return $this->successResponse();
        } catch (NotFoundException | BadDataException $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * @param int $classroom
     * @param ClassroomDataProvider $classroomDataProvider
     * @param ClassroomService $classroomService
     * @return JsonResponse
     */
    public function delete(
        int $classroom,
        ClassroomDataProvider $classroomDataProvider,
        ClassroomService $classroomService
    ) :JsonResponse
    {
        try {
            $classroom = $classroomDataProvider->getOne($classroom);
            $classroomService->deleteClassroom($classroom);

            return $this->successResponse();
        } catch (NotFoundException $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * @param int $classroom
     * @param ClassroomDataProvider $classroomDataProvider
     * @param ClassroomService $classroomService
     * @return JsonResponse
     */
    public function changeStatus(
        int $classroom,
        ClassroomDataProvider $classroomDataProvider,
        ClassroomService $classroomService
    ) :JsonResponse
    {
        try {
            $classroom = $classroomDataProvider->getOne($classroom);
            $classroomService->changeStatusClassroom($classroom);

            return $this->successResponse();
        } catch (NotFoundException $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }
}
