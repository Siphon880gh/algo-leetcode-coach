<?php
declare(strict_types=1);

return [
    'title' => 'License Key Formatting: strip dashes, uppercase, group from the right',
    'leetcode' => 482,
    'difficulty' => 'Easy',
    'summary' => 'Reformat a key into groups of k, separated by dashes, uppercase, where only the first group may be shorter (but not empty). Drop the dashes, uppercase, and group from the end: walk backward and add a dash after every k characters. "5F3Z-2e-9-w", 4 → "5F3Z-2E9W". "2-5g-3-J", 2 → "2-5G-3J". All dashes → "".',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'simulation', 'leetcode'],
    'related_session' => 'license-key-formatting',
];
