<?php
$links = [
  ['title' => 'Dashboard', 'href' => '/dashboard'],
  ['title' => 'Add budget', 'href' => '/budgets/create'],
  ['title' => 'Budgets', 'href' => '/budgets'],
  ['title' => 'Record income', 'href' => '/transactions/create/income'],
  ['title' => 'Record expense', 'href' => '/transactions/create/expense'],
  ['title' => 'Transactions', 'href' => '/transactions'],
  ['title' => 'Generate report', 'href' => '/reports/create'],
  ['title' => 'Reports', 'href' => '/reports'],
];
?>

<nav class="p-4">
  <div class="mb-4 text-center px-2">
    <img src="/res/user.webp" class="rounded-circle d-block mx-auto mb-1" width="50" height="50" />
    <div><?= $user->getFullName() ?></div>
  </div>

  <ul class="list-group list-unstyled">
    <?php foreach($links as $link) : ?>
      <li>
        <a 
          href="<?= $link['href'] ?>" 
          class="list-group-item list-group-item-action mb-4 rounded list-group-item-success <?= $_SERVER['REQUEST_URI'] === $link['href'] ? 'bg-success text-white' : '' ?>"
        >
          <?= $link['title'] ?>
        </a>
      </li>
    <?php endforeach; ?>

    <li>
      <form action="/sign-out" method="POST">
        <button type="submit" class="w-100 btn btn-danger">Sign out</button>
      </form>
    </li>
  </ul>
</nav>
