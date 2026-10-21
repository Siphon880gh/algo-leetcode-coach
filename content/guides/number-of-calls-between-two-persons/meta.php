<?php
declare(strict_types=1);

return [
    'title' => 'Number of Calls Between Two Persons: normalise the pair',
    'leetcode' => 1699,
    'difficulty' => 'Med',
    'summary' => 'Map each call to (LEAST(from, to), GREATEST(from, to)), then group by that pair, counting rows and summing duration.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'leetcode'],
    'related_session' => 'number-of-calls-between-two-persons',
];
