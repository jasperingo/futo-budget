<div class="container p-2">
  <h2>Create budget</h2>

  <form action="/budgets" method="POST" class="border border-success p-4 mx-auto rounded needs-validation" style="max-width: 500px;">
    <div class="mb-3">
      <label for="title-input" class="form-label">Title</label>
      <input type="text" class="form-control <?= isset($titleError) ? 'is-invalid' : '' ?>" id="title-input" name="title" value="<?= $title ?>" required />
      <div class="invalid-feedback"><?= $titleError ?></div>
    </div>

    <div class="mb-3">
      <label for="amount-input" class="form-label">Amount (NGN)</label>
      <input type="number" step="0.01" class="form-control <?= isset($amountError) ? 'is-invalid' : '' ?>" id="amount-input" name="amount" value="<?= $amount ?>" min="0" required />
      <div class="invalid-feedback"><?= $amountError ?></div>
    </div>

    <div class="mb-3">
      <label for="due-at-input" class="form-label">Due date</label>
      <input type="datetime-local" class="form-control <?= isset($dueAtError) ? 'is-invalid' : '' ?>" id="due-at-input" name="due_at" value="<?= $dueAt ?>" required />
      <div class="invalid-feedback"><?= $dueAtError ?></div>
    </div>
    
    <button type="submit" class="w-100 btn btn-success">Submit</button>
  </form>
  
</div>
