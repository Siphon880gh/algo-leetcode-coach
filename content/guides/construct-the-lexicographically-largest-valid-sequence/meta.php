<?php
declare(strict_types=1);

return [
    'title' => 'Construct the Lexicographically Largest Valid Sequence: backtracking from big to small',
    'leetcode' => 1718,
    'difficulty' => 'Med',
    'summary' => 'Fill positions left to right, trying values from n down to 1. A value v > 1 needs positions i and i + v free; 1 needs only i. The first full fill is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'array', 'leetcode'],
    'related_session' => 'construct-the-lexicographically-largest-valid-sequence',
];
