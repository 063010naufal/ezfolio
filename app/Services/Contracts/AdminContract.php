<?php

namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface AdminContract
{
    /**
     * Get the corresponding model
     * 
     * @return User 
     */
    public function getModel();

    /**
     * Handle login
     * 
     * @param array $data 
     * @return array 
     * @throws InvalidArgumentException 
     */
    public function handleLogin(array $data);

    /**
     * Handle signup
     * 
     * @param array $data 
     * @return array 
     * @throws InvalidArgumentException 
     */
    public function handleSignup(array $data);

    /**
     * Fetch data by email
     * 
     * @param string $email 
     * @param array $select 
     * @return array 
     */
    public function getByEmail(string $email, array $select = ['*']);

    /**
     * Handle forget password
     * 
     * @param array $data 
     * @return array 
     * @throws InvalidArgumentException 
     */
    public function handleForgetPassword(array $data);

    /**
     * Handle reset password
     * 
     * @param array $data 
     * @return array 
     * @throws InvalidArgumentException 
     */
    public function handleResetPassword(array $data);

    /**
     * Get the authenticated User
     *
     * @return JsonResponse
     */
    public function me();

    /**
     * Refresh a token
     *
     * @return JsonResponse
     */
    public function refreshToken();
}
