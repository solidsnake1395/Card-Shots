<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestDbController extends AbstractController
{
    #[Route('/test-db', name: 'test_db')]
    public function testDb(Connection $connection): JsonResponse
    {
        try {
            // Intentar obtener la URL de conexión (sin la contraseña)
            $params = $connection->getParams();
            $url = sprintf(
                "mysql://%s@%s:%s/%s",
                $params['user'],
                $params['host'],
                $params['port'],
                $params['dbname']
            );

            // Intentar hacer una consulta simple
            $result = $connection->executeQuery('SELECT 1')->fetchOne();
            
            return new JsonResponse([
                'status' => 'success',
                'connection_url' => $url,
                'result' => $result
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'connection_url' => $url ?? 'No disponible'
            ], 500);
        }
    }
}
