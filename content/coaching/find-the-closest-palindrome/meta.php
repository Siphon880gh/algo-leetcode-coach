<?php
declare(strict_types=1);

return [
    'title' => 'Find the Closest Palindrome: five candidates from the left half',
    'leetcode' => 564,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: mirror the left half (minus one, as is, plus one), add 9…9 and 10…01, drop n, and pick the closest, smaller on ties. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'find-the-closest-palindrome',
    'tags' => ['math', 'strings', 'step-by-step'],
];
