<div class="container p-2">
  <h2>Transactions</h2>

  <?= $this->fetch('./transactions-table.php', ['transactions' => $transactions]) ?>
</div>
