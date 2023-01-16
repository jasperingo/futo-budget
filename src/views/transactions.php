<div class="container p-2">
  <h2>Transactions</h2>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Amount (NGN)</th>
        <th>Description</th>
        <th>Creation date</th>
        <th>Budget</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach($transactions as $transaction) : ?>

      <tr>
        <td><?= $transaction->id ?></td>
        <td><?= $transaction->type->value ?></td>
        <td><?= number_format($transaction->amount, 2, '.', ',') ?></td>
        <td><?= $transaction->description ?></td>
        <td><?= $transaction->createdAt->format('Y-m-d H:i:s') ?></td>
        
        <?php if (isset($transaction->budget)) : ?>
        <td><?= $transaction->budget->title ?> (id: <?= $transaction->budget->id ?>)</td>
        <?php else : ?>
        <td>None</td>
        <?php endif; ?>
      </tr>

      <?php endforeach; ?>

      <?php if (empty($transactions)) : ?>

      <tr>
        <td colspan="6">
          <div class="alert alert-warning text-center" role="alert">There is no transaction</div>
        </td>
      </tr>

      <?php endif; ?>
    </tbody>
  </table>
  
</div>
