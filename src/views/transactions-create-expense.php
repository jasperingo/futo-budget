<div class="container p-2">
  <h2>Record expense</h2>
  
  <form action="/transactions" method="POST" class="border border-success p-4 mx-auto rounded needs-validation" style="max-width: 500px;">
    <input type="hidden" value="Expense" name="type" />

    <div class="mb-3">
      <label for="amount-input" class="form-label">Amount (NGN)</label>
      <input type="number" step="0.01" class="form-control <?= isset($amountError) ? 'is-invalid' : '' ?>" id="amount-input" name="amount" value="<?= $amount ?>" min="0" required />
      <div class="invalid-feedback"><?= $amountError ?></div>
    </div>

    <div class="mb-3">
      <label for="description-input" class="form-label">Description</label>
      <textarea class="form-control <?= isset($descriptionError) ? 'is-invalid' : '' ?>" id="description-input" name="description" required><?= $description ?></textarea>
      <div class="invalid-feedback"><?= $descriptionError ?></div>
    </div>

    <div class="mb-3">
      <label for="budget-input" class="form-label">Budget</label>
      <select class="form-select <?= isset($budgetError) ? 'is-invalid' : '' ?>" id="budget-input" name="budget">
        <option value="">--Select one--</option>
        
        <?php foreach($budgets as $budg) : ?>
        <option value="<?= $budg->id ?>" <?= $budget == $budg->id ? 'selected' : '' ?>><?= $budg->title ?></option>
        <?php endforeach; ?>
      </select>
      <div class="invalid-feedback"><?= $budgetError ?></div>
    </div>
    
    <button type="submit" class="w-100 btn btn-success">Submit</button>
  </form>
</div>
