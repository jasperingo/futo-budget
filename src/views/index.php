<div class="container p-2">
  <h2 class="text-center text-success py-4">A budgeting application for Federal University of Technology Owerri</h2>

  <form action="" method="POST" class="border border-success p-4 mx-auto rounded needs-validation" style="max-width: 500px;">
    <?php if (isset($error)) : ?>
    
    <div class="alert alert-danger" role="alert"><?= $error ?></div>
 
    <?php endif; ?>

    <div class="mb-3">
      <label for="email-input" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email-input" name="email" value="<?= $email ?>" required />
    </div>

    <div class="mb-3">
      <label for="password-input" class="form-label">Password</label>
      <input type="password" class="form-control" id="password-input" name="password" required />
    </div>
    
    <button type="submit" class="w-100 btn btn-success">Sign in</button>
  </form>

</div>
