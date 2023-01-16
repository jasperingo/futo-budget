<?php
$links = [
  ['title' => 'Dashboard', 'href' => '/dashboard'],
  ['title' => 'Add budget', 'href' => '/budgets/create'],
  ['title' => 'Budgets', 'href' => '/budgets'],
  ['title' => 'Record income', 'href' => '/transactions/create/income'],
  ['title' => 'Record expense', 'href' => '/transactions/create/expense'],
  ['title' => 'Transactions', 'href' => '/transactions'],
];
?>

<nav class="p-4">
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
  </ul>
</nav>
