<?php
declare(strict_types=1);

return [
    'title' => 'Find Maximum Number of Non-Intersecting Substrings',
    'leetcode' => 3557,
    'difficulty' => 'Med',
    'summary' => 'Greedy: end each substring as early as possible. Remember the first position of each letter since the last cut; when a letter repeats at least 3 positions later, take that substring, cut, and clear the memory.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-maximum-number-of-non-intersecting-substrings',
    'related_session' => 'find-maximum-number-of-non-intersecting-substrings',
];
