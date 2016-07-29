<?php

namespace CodeOrders\V1\Rest\Users;

use CodeOrders\V1\Rest\Auth\AuthService;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class UsersResource extends AbstractResourceListener
{
    /**
     * @var AuthService
     */
    private $authService;
    /**
     * @var UsersService
     */
    private $usersService;
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * UsersResource constructor.
     * @param AuthService $authService
     * @param UsersService $usersService
     * @param UsersRepository $usersRepository
     */
    public function __construct(AuthService $authService, UsersService $usersService, UsersRepository $usersRepository)
    {
        $this->authService = $authService;
        $this->usersService = $usersService;
        $this->usersRepository = $usersRepository;
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
            return $this->usersService->insert($data);
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
            return $this->usersRepository->delete($id);
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
            $this->authService->hasRole('admin');
            return $this->usersRepository->find($id);
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
            $this->authService->hasRole('admin');
            return $this->usersRepository->findAll();
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
            $this->authService->hasRole(['admin', 'salesman']);
            if ($this->authService->isAdmin()) {
                return $this->usersService->update($id, $data);
            } elseif ((int)$id == $this->authService->getUser()->getId()) {
                if (isset($data->role)) {
                    unset($data->role);
                }
                return $this->usersService->update($id, $data);
            }
            return new ApiProblem(401, 'Access denied');
        } catch (\Exception $e) {
            return new ApiProblem($e->getCode(), $e->getMessage());
        }
    }
}
