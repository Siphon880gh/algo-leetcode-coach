<?php
declare(strict_types=1);

return [
    'title' => 'Longest Almost-Palindromic Substring',
    'leetcode' => 3844,
    'difficulty' => 'Med',
    'summary' => 'Expand around each center; when the two ends first differ, try skipping the left or the right character and keep expanding. The longest span reached (with exactly one removal, so length ≥ 2) is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-almost-palindromic-substring',
    'related_session' => 'longest-almost-palindromic-substring',
];
