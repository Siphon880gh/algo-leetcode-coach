<?php
declare(strict_types=1);

return [
    'title' => 'Design a Food Rating System: a heap per cuisine',
    'leetcode' => 2353,
    'difficulty' => 'Med',
    'summary' => 'Map each food to its cuisine and current rating, and keep a heap per cuisine ordered by rating descending, then name. changeRating pushes a new entry; highestRated pops stale tops whose rating no longer matches.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'array', 'hash-table', 'string', 'ordered-set', 'heap', 'leetcode'],
    'related_session' => 'design-a-food-rating-system',
];
