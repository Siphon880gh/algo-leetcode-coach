<?php
declare(strict_types=1);

return [
    'title' => 'Merge Adjacent Equal Elements',
    'leetcode' => 3834,
    'difficulty' => 'Med',
    'summary' => 'Use a stack. Push each value; while the top two are equal, pop both and push their sum. The leftmost equal pair is always at the top of what has been processed, so this matches the rule.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'merge-adjacent-equal-elements',
    'related_session' => 'merge-adjacent-equal-elements',
];
