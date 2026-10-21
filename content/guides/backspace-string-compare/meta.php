<?php
declare(strict_types=1);

return [
    'title' => 'Backspace String Compare: walk both strings from the end',
    'leetcode' => 844,
    'difficulty' => 'Easy',
    'summary' => 'Scan both strings from the right, skipping characters erased by pending backspaces. Compare the next surviving characters one pair at a time; this uses O(1) space instead of building the final strings.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'stack', 'strings', 'leetcode'],
    'related_session' => 'backspace-string-compare',
];
