<?php

class User{
    public function __construct(
        public string $email,
        public string $password,
        public string $password2,
        public string $pseudo,
    )
    {
    }

    public function verify():bool{
        $isValid = true;

        if ($this->email === '' || $this->pseudo === ''){
            $isValid = false;
        }

        if ($this->password === '' || $this->password !== $this->password2){
            $isValid = false;
        }

        return $isValid;
    }
}