<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Deletions to Make Array Beautiful: greedy pairing',
    'leetcode' => 2216,
    'difficulty' => 'Med',
    'summary' => 'Scan once, building pairs. When the current element would sit at an odd position of the kept array and equals the one before it, delete it. If the kept length ends odd, delete one more.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'stack', 'greedy', 'leetcode'],
    'related_session' => 'minimum-deletions-to-make-array-beautiful',
];
