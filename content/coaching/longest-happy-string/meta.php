<?php
declare(strict_types=1);

return [
    'title' => 'Longest Happy String: most remaining, avoid triples',
    'leetcode' => 1405,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: pick the letter with the most copies left unless the last two are that letter, in which case use the next most frequent, stopping when nothing fits. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'longest-happy-string',
    'tags' => ['greedy', 'heap', 'strings', 'step-by-step'],
];
