<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make Character Frequencies Equal: try every target, DP over letters',
    'leetcode' => 3389,
    'difficulty' => 'Hard',
    'summary' => 'Fix the common frequency t. Each letter ends at 0 or t. Extra copies cost 1 each whether deleted or changed to the next letter, and a change can cover the next letter’s shortage, saving an insertion. Changing further than one letter is never better than delete plus insert.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'dynamic-programming', 'counting', 'enumeration', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-character-frequencies-equal',
];
