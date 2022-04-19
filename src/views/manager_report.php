<main class="content">
  <?php
    renderTitle(
      'Relatório Gerencial',
      'Acompanhe seu saldo de horas',
      'icofont-chart-histogram'
    );
  ?>
  <?php
    echo $activeUsersCount . ' usuários ativos <br>';
    print_r($absentUsers);
    echo ' usuários ausentes <br>';
    echo $hoursInMonth . ' horas trabalhadas no mês <br>';
  ?>
</main>