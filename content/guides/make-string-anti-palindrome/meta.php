<?php
declare(strict_types=1);

return [
    'title' => 'Make String Anti-palindrome: sort, then fix the middle',
    'leetcode' => 3088,
    'difficulty' => 'Hard',
    'summary' => 'Sort s. Only the middle can clash: if s[n/2] equals s[n/2 − 1], swap the clashing right-half letters, from the middle onward, with the first letters after that run that differ. If none are left, no answer exists.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'string', 'sorting', 'leetcode'],
    'related_session' => 'make-string-anti-palindrome',
];
