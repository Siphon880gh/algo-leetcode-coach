<?php
declare(strict_types=1);

return [
    'title' => 'Design Movie Rental System: ordered sets per movie and for rentals',
    'leetcode' => 1912,
    'difficulty' => 'Hard',
    'summary' => 'Keep, per movie, an ordered set of (price, shop) for unrented copies, and one global ordered set of (price, shop, movie) for rented copies. Rent and drop move an entry between them; search and report read the first five.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'ordered-set', 'heap', 'hash-table', 'leetcode'],
    'related_session' => 'design-movie-rental-system',
];
