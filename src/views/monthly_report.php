<main class="content">
  <?php
    $title = 'Relatório Mensal';
    $subtitle = 'Acompanhe seu saldo de horas';
    $icon = 'icofont-ui-calendar';
    renderTitle($title, $subtitle, $icon);
  ?>
  <div>
    <form class="mb-4" action="#" method="post">
      <div class="input-group">
        <?php if($user->is_admin): ?>
          <select name="user" id="user" class="form-control mr-2"
            placeholder="Selecione o Usuário...">
            <?php foreach($users as $user) : ?>
            <?php $selected = $user->id === $selectedUser ? 'selected' : ''; ?>
              <option value='<?= $user->id ?>' <?= $selected ?>><?= $user->name ?></option>;
            <?php endforeach ?>
          </select>
        <?php endif ?>
        <select name="period" id="period" class="form-control mr-2"
          placeholder="Selecione o Período...">
          <?php foreach($periods as $key => $month) : ?>
          <?php $selected = $key === $selectedPeriod ? 'selected' : ''; ?>
            <option value='<?= $key ?>' <?= $selected ?>><?= $month ?></option>;
          <?php endforeach ?>
        </select>
        <button class="btn btn-primary">
          <i class="icofont-search"></i>
        </button>
      </div>
    </form>
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <th>Dia</th>
        <th>Entrada 1</th>
        <th>Saída 1</th>
        <th>Entrada 2</th>
        <th>Saída 2</th>
        <th>Saldo</th>
      </thead>
      <tbody>
        <?php foreach($report as $registry): ?>
          <tr>
            <td><?= formatDateWithLocale($registry->work_date, '%A, %d de %B de %Y') ?></td>
            <td><?= $registry->time1 ?? '-' ?></td>
            <td><?= $registry->time2 ?? '-' ?></td>
            <td><?= $registry->time3 ?? '-' ?></td>
            <td><?= $registry->time4 ?? '-' ?></td>
            <td><?= $registry->getBalance() ?></td>
          </tr>
        <?php endforeach ?>
        <tr class="bg-primary text-white">
          <td>Horas Trabalhadas</td>
          <td colspan="3"><?= $sumOfWorkedTime ?></td>
          <td>Saldo Mensal</td>
          <td><?= $balance ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</main>