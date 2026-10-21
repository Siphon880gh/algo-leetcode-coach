<?php
declare(strict_types=1);

return [
    'title' => 'Unpopular Books: left join recent orders',
    'leetcode' => 1098,
    'difficulty' => 'Med',
    'summary' => 'Keep books that have been available long enough, left join only the orders from the past year, and keep the books whose summed quantity, with no orders counting as 0, is below the threshold.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'unpopular-books',
];
