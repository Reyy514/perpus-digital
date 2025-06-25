<?php

namespace App\Observers;

use App\Models\AdminActivityLog;
use App\Models\Category;

class CategoryObserver
{
    protected function logAction(string $action, Category $category)
    {
        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model' => Category::class,
            'model_id' => $category->id,
            'details' => "Kategori '{$category->name}'",
        ]);
    }

    public function created(Category $category): void { $this->logAction('created', $category); }
    public function updated(Category $category): void { $this->logAction('updated', $category); }
    public function deleted(Category $category): void { $this->logAction('deleted', $category); }
}