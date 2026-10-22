<?php
declare(strict_types=1);

return [
    'title' => 'Remove Adjacent Almost-Equal Characters: change the second, skip ahead',
    'leetcode' => 2957,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right. When word[i] is almost-equal to word[i − 1], change word[i] to something safe; that also fixes the pair (i, i + 1), so skip to i + 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'remove-adjacent-almost-equal-characters',
];
