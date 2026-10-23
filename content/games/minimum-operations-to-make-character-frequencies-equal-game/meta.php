<?php
declare(strict_types=1);

return [
    'title' => 'Make Character Frequencies Equal: try every target count',
    'leetcode' => 3389,
    'difficulty' => 'Hard',
    'summary' => 'Try each target f. Walk letters a→z; each letter ends with 0 or f copies. Extra copies cost 1 each (delete, or change to the next letter, where they can fill a shortage); missing copies cost 1 each (insert). Keep the best per f.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-operations-to-make-character-frequencies-equal',
    'related_session' => 'minimum-operations-to-make-character-frequencies-equal',
];
