<?php
namespace Futo\Budget\Models;

enum TransactionType: string {
  case Income = 'Income';
  
  case Expense = 'Expense';
}
