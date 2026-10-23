<?php
declare(strict_types=1);

return [
    'title' => 'Split Concatenated Strings: best orientation, then try each cut',
    'leetcode' => 555,
    'difficulty' => 'Med',
    'summary' => 'Every string except the one we cut should use its larger orientation. For each string i, both orientations, and every cut point k: candidate = t[k:] + (others in loop order) + t[:k]. Keep the largest.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'split-concatenated-strings',
    'related_session' => 'split-concatenated-strings',
];
