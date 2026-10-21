<?php
declare(strict_types=1);

return [
    'title' => 'Biggest Single Number: singles first, then MAX',
    'leetcode' => 619,
    'difficulty' => 'Easy',
    'summary' => 'Keep the numbers that appear exactly once with GROUP BY … HAVING COUNT(*) = 1, then take MAX, which returns null when there are none.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'group-by', 'leetcode'],
    'related_session' => 'biggest-single-number',
];
