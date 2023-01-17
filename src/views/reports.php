<div class="container p-2">
  <h2>Reports</h2>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Total income (NGN)</th>
        <th>Total expense (NGN)</th>
        <th>Start period</th>
        <th>End period</th>
        <th>Creation date</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach($reports as $report) : ?>

      <tr>
        <td><?= $report->id ?></td>
        <td><?= number_format($report->totalIncome, 2, '.', ',') ?></td>
        <td><?= number_format($report->totalExpense, 2, '.', ',') ?></td>
        <td><?= $report->startedAt->format('Y-m-d H:i:s') ?></td>
        <td><?= $report->endedAt->format('Y-m-d H:i:s') ?></td>
        <td><?= $report->createdAt->format('Y-m-d H:i:s') ?></td>
      </tr>

      <?php endforeach; ?>

      <?php if (empty($reports)) : ?>

      <tr>
        <td colspan="6">
          <div class="alert alert-warning text-center" role="alert">There is no report</div>
        </td>
      </tr>

      <?php endif; ?>
    </tbody>
  </table>
</div>
