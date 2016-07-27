<?php

namespace CodeOrders\V1\Rest\Orders;

use CodeOrders\V1\Rest\Auth\AuthService;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class OrdersResource extends AbstractResourceListener
{
    /**
     * @var AuthService
     */
    private $authService;
    /**
     * @var OrdersRepository
     */
    private $repository;
    /**
     * @var OrdersService
     */
    private $service;

    /**
     * OrdersResource constructor.
     * @param AuthService $authService
     * @param OrdersRepository $repository
     * @param OrdersService $service
     */
    public function __construct(AuthService $authService, OrdersRepository $repository, OrdersService $service)
    {
        $this->authService = $authService;
        $this->repository = $repository;
        $this->service = $service;
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
            $this->authService->hasRole(['admin', 'salesman']);
            $data->user_id = $this->authService->getUser()->getId();
            return $this->service->insert($data);
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
            return $this->service->delete($id);
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
            if ($this->authService->isAdmin()) {
                return $this->repository->find($id);
            } else {
                return $this->repository->findBySalesman($id, $this->authService->getUser()->getId());
            }
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
            if ($this->authService->isAdmin()) {
                return $this->repository->findAll();
            } else {
                return $this->repository->findAllBySalesman($this->authService->getUser()->getId());
            }
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
            return $this->service->update($id, $data);
        } catch (\Exception $e) {
            return new ApiProblem($e->getCode(), $e->getMessage());
        }
    }
}
