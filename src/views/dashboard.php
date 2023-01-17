<div class="container p-2">
  <h2>Dashboard</h2>

  <div class="row mt-4">
    <div class="col">
      <div class="alert alert-success mb-4" role="alert">
        <h3 class="fs-5 fw-bold">Account balance</h3>
        <div class="fs-3">NGN <?= number_format($accountBalance, 2, '.', ',') ?></div>
      </div>

      <div class="border border-success p-2 rounded">
        <h3 class="fs-5 fw-bold">Budgets</h3>

        <?= $this->fetch('./budgets-table.php', ['budgets' => $budgets]) ?>
      </div>
    </div>

    <div class="col">
      <div class="border border-success p-2 rounded">
        <h3 class="fs-5 fw-bold">Transactions</h3>
        
        <?= $this->fetch('./transactions-table.php', ['transactions' => $transactions]) ?>
      </div>
    </div>
  </div>
</div>
