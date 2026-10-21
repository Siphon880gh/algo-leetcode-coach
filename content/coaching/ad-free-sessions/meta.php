<?php
declare(strict_types=1);

return [
    'title' => 'Ad-Free Sessions: anti-join on time overlap',
    'leetcode' => 1809,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: LEFT JOIN ads on the same customer with the timestamp inside the session, and keep sessions where nothing matched. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'ad-free-sessions',
    'tags' => ['sql', 'join', 'step-by-step'],
];
