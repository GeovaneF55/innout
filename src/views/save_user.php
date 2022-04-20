<main class="content">
  <?php
    $title = 'Cadastro de Usuário';
    $subtitle = 'Crie e Atualize o usuário';
    $icon = 'icofont-user';
    renderTitle($title, $subtitle, $icon);
    include(TEMPLATE_PATH . "/messages.php");
  ?>

  <form action="#" method="post">
    <input type="hidden" name="id" id="id"
      value="<?= isset($id) ? $id : '' ?>">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" placeholder="Informe o nome"
          class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
          value="<?= isset($name) ? $name : '' ?>">
        <div class="invalid-feedback">
          <?= $errors['name'] ?? '' ?>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Informe o Email"
          class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
          value="<?= isset($email) ? $email : '' ?>">
        <div class="invalid-feedback">
          <?= $errors['email'] ?? '' ?>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="password">Senha</label>
        <input type="password" name="password" id="password" placeholder="Informe a senha"
          class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
        <div class="invalid-feedback">
          <?= $errors['password'] ?? '' ?>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="confirm_password">Confirme a Senha</label>
        <input type="password" name="confirm_password" id="confirm_password"
          placeholder="Confirme a senha" class="form-control
          <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>">
        <div class="invalid-feedback">
          <?= $errors['confirm_password'] ?? '' ?>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="start_date">Data de Admissão</label>
        <input type="date" name="start_date" id="start_date"
          class="form-control <?= isset($errors['start_date']) ? 'is-invalid' : '' ?>"
          value="<?= isset($start_date) ? $start_date : '' ?>">
        <div class="invalid-feedback">
          <?= $errors['start_date'] ?? '' ?>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="end_date">Data de Desligamento</label>
        <input type="date" name="end_date" id="end_date"
          class="form-control <?= isset($errors['end_date']) ? 'is-invalid' : '' ?>"
          value="<?= isset($end_date) ? $end_date : '' ?>">
        <div class="invalid-feedback">
          <?= $errors['end_date'] ?? '' ?>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="is_admin">Administrador?</label>
        <input type="checkbox" name="is_admin" id="is_admin"
          class="form-control <?= isset($errors['is_admin']) ? 'is-invalid' : '' ?>"
          <?= isset($is_admin) && $is_admin ? 'checked' : '' ?>>
        <div class="invalid-feedback">
          <?= $errors['is_admin'] ?? '' ?>
        </div>
      </div>
    </div>
    <div>
      <button class="btn btn-lg btn-primary">Salvar</button>
      <a href="/users.php"
        class="btn btn-lg btn-secondary">Cancelar</a>
    </div>
  </form>
</main>