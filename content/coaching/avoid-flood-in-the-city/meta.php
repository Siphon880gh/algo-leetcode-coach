<?php
declare(strict_types=1);

return [
    'title' => 'Avoid Flood in The City: assign dry days lazily',
    'leetcode' => 1488,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: remember when each lake filled; when it rains again on a full lake, use the first dry day after that fill (binary search); none → []. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'avoid-flood-in-the-city',
    'tags' => ['greedy', 'binary-search', 'ordered-set', 'step-by-step'],
];
