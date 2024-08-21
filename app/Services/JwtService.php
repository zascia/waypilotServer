<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    private $secretKey = 'your-secret-key';

    public function generateToken($data)
    {
        return JWT::encode($data, $this->secretKey, 'HS256');
    }

    public function decodeToken($token)
    {
        return JWT::decode($token, new Key($this->secretKey, 'HS256'));
    }
}
