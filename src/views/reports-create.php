<div class="container p-2">
  <h2>Create report</h2>
  
  <form action="/reports" method="POST" class="border border-success p-4 mx-auto rounded needs-validation" style="max-width: 500px;">
    <div class="mb-3">
      <label for="start-input" class="form-label">Start period</label>
      <input type="datetime-local" class="form-control <?= isset($startedAtError) ? 'is-invalid' : '' ?>" id="start-input" name="started_at" value="<?= $startedAt ?>" required />
      <div class="invalid-feedback"><?= $startedAtError ?></div>
    </div>

    <div class="mb-3">
      <label for="end-input" class="form-label">End period</label>
      <input type="datetime-local" class="form-control <?= isset($endedAtError) ? 'is-invalid' : '' ?>" id="end-input" name="ended_at" value="<?= $endedAt ?>" required />
      <div class="invalid-feedback"><?= $endedAtError ?></div>
    </div>
    
    <button type="submit" class="w-100 btn btn-success">Submit</button>
  </form>
</div>
