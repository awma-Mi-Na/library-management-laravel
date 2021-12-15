<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Author
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read int|null $books_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\AuthorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author query()
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereUserId($value)
 */
	class Author extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Book
 *
 * @property int $id
 * @property int $isbn
 * @property string $title
 * @property int $author_id
 * @property string $slug
 * @property string $summary
 * @property int $copies
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Author $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookCategory[] $book_categories
 * @property-read int|null $book_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Borrowing_history[] $borrowing_histories
 * @property-read int|null $borrowing_histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Borrowing[] $borrowings
 * @property-read int|null $borrowings_count
 * @method static \Database\Factories\BookFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Book filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCopies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereIsbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUpdatedAt($value)
 */
	class Book extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BookCategory
 *
 * @property int $id
 * @property int $book_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book $book
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookCategory whereUpdatedAt($value)
 */
	class BookCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Borrowing
 *
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $due_date
 * @property-read \App\Models\User $borrower
 * @property-read \App\Models\Book $borrows
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing whereUserId($value)
 */
	class Borrowing extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Borrowing_history
 *
 * @property int $id
 * @property int|null $borrowing_id
 * @property int $user_id
 * @property int $book_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $due_date
 * @property string|null $returned_date
 * @property int $status
 * @property-read \App\Models\User $borrower
 * @property-read \App\Models\Book $borrows
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history filter(array $terms)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history query()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history whereBorrowingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history whereReturnedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing_history whereUserId($value)
 */
	class Borrowing_history extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Borrowing_history[] $borrowing_histories
 * @property-read int|null $borrowing_histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Borrowing[] $borrowings
 * @property-read int|null $borrowings_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

