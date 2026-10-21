<?php
declare(strict_types=1);

return [
    'title' => 'License Key Formatting: strip dashes, uppercase, group from the right',
    'leetcode' => 482,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: regroup a key into groups of k, uppercase, joined by dashes, where only the first group may be shorter. Drop dashes and group from the right. "5F3Z-2e-9-w", 4 → "5F3Z-2E9W". "2-5g-3-J", 2 → "2-5G-3J". Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'tags' => ['strings', 'simulation', 'step-by-step'],
    'related_guide' => 'license-key-formatting',
];
