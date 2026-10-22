<?php
declare(strict_types=1);

return [
    'title' => 'Find the Longest Semi-Repetitive Substring: drop the older pair exactly',
    'leetcode' => 2730,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: allow one adjacent equal pair, and when a second appears move the left edge to the earlier pair’s second digit. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'find-the-longest-semi-repetitive-substring',
    'tags' => ['string', 'sliding-window', 'step-by-step'],
];
