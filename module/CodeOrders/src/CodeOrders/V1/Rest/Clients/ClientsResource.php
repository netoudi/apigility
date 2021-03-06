<?php

namespace CodeOrders\V1\Rest\Clients;

use CodeOrders\V1\Rest\Auth\AuthService;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class ClientsResource extends AbstractResourceListener
{
    /**
     * @var AuthService
     */
    private $authService;
    /**
     * @var ClientsRepository
     */
    private $repository;

    /**
     * ClientsResource constructor.
     * @param AuthService $authService
     * @param ClientsRepository $repository
     */
    public function __construct(AuthService $authService, ClientsRepository $repository)
    {
        $this->authService = $authService;
        $this->repository = $repository;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        try {
            $this->authService->hasRole('admin');
            return $this->repository->insert($data);
        } catch (\Exception $e) {
            return new ApiProblem($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        try {
            $this->authService->hasRole('admin');
            return $this->repository->delete($id);
        } catch (\Exception $e) {
            return new ApiProblem($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        try {
            $this->authService->hasRole(['admin', 'salesman']);
            return $this->repository->find($id);
        } catch (\Exception $e) {
            return new ApiProblem($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        try {
            $this->authService->hasRole(['admin', 'salesman']);
            return $this->repository->findAll();
        } catch (\Exception $e) {
            return new ApiProblem($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        try {
            $this->authService->hasRole('admin');
            return $this->repository->update($id, $data);
        } catch (\Exception $e) {
            return new ApiProblem($e->getCode(), $e->getMessage());
        }
    }
}
