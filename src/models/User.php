<?php
  class User extends Model {
    protected static $tableName = "users";
    protected static $columns = [
      'id',
      'name',
      'email',
      'password',
      'start_date',
      'end_date',
      'is_admin'
    ];

    public static function getActiveUsersCount() {
      return static::getCount(['raw' => 'end_date IS NULL']);
    }

    public function insert() {
      $this->validate();
      $this->is_admin = $this->is_admin ? 1 : 0;
      if(!$this->end_date) $this->end_date = null;
      $this->password = password_hash($this->password, PASSWORD_DEFAULT);
      return parent::insert();
    }

    public function update() {
      $this->validate();
      $this->is_admin = $this->is_admin ? 1 : 0;
      if(!$this->end_date) $this->end_date = null;
      $this->password = password_hash($this->password, PASSWORD_DEFAULT);
      return parent::update();
    }

    private function validate() {
      $errors = [];

      if(!$this->name) {
        $errors['name'] = 'Nome é obrigatório';
      }

      if(!$this->email) {
        $errors['email'] = 'Email é obrigatório';
      } elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email inválido';
      }

      if(!$this->password) {
        $errors['password'] = 'Senha é obrigatória';
      }
      
      if(!$this->confirm_password) {
        $errors['confirm_password'] = 'Confirme a Senha é obrigatória';
      }

      if($this->password && $this->confirm_password &&
        $this->password !== $this->confirm_password) {
        $errors['password'] = 'Senha e Confirme a Senha não conferem';
        $errors['confirm_password'] = 'Senha e Confirme a Senha não conferem';
      }

      if(!$this->start_date) {
        $errors['start_date'] = 'Data de Admissão é obrigatória';
      } elseif(!Datetime::createFromFormat('Y-m-d', $this->start_date)) {
        $errors['start_date'] = 'Data de Admissão inválida (dd/mm/yyyy)';
      }

      if($this->end_date && !Datetime::createFromFormat('Y-m-d', $this->end_date)) {
        $errors['end_date'] = 'Data de Desligamento inválida (dd/mm/yyyy)';
      }

      if(count($errors) > 0) {
        throw new ValidationException($errors);
      }
    }
  }