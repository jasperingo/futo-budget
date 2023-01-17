<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Amount (NGN)</th>
      <th>Due date</th>
      <th>Creation date</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($budgets as $budget) : ?>

    <tr>
      <td><?= $budget->id ?></td>
      <td><?= $budget->title ?></td>
      <td><?= number_format($budget->amount, 2, '.', ',') ?></td>
      <td><?= $budget->dueAt->format('Y-m-d H:i:s') ?></td>
      <td><?= $budget->createdAt->format('Y-m-d H:i:s') ?></td>
    </tr>

    <?php endforeach; ?>

    <?php if (empty($budgets)) : ?>

    <tr>
      <td colspan="5">
        <div class="alert alert-warning text-center" role="alert">There is no budget</div>
      </td>
    </tr>

    <?php endif; ?>
  </tbody>
</table>