<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    /**
     * Returns api error response
     *
     * @param array ...$errors
     * @return JsonResponse
     */
    protected function errorResponse(...$errors): JsonResponse
    {
        $response = [
            'success' => false,
            'errors' => $errors
        ];

        return $this->json($response);
    }

    /**
     * Returns api success response
     *
     * @param array $data
     * @return JsonResponse
     */
    protected function successResponse($data = []): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $data
        ];

        return $this->json($response);
    }
}