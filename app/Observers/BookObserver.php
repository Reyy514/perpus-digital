<?php

namespace App\Observers;

use App\Models\AdminActivityLog;
use App\Models\Book;

class BookObserver
{
    protected function logAction(string $action, Book $book)
    {
        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model' => Book::class,
            'model_id' => $book->id,
            'details' => "Buku '{$book->title}'",
        ]);
    }

    public function created(Book $book): void { $this->logAction('created', $book); }
    public function updated(Book $book): void { $this->logAction('updated', $book); }
    public function deleted(Book $book): void { $this->logAction('deleted', $book); }
}