<?php
declare(strict_types=1);

return [
    'title' => 'Basic Calculator',
    'leetcode' => 224,
    'difficulty' => 'Hard',
    'summary' => 'Scan left to right with a running result and sign. On "(", push (result, sign) and start fresh; on ")", finish the inner value and combine it with the popped result and sign.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'basic-calculator',
    'related_session' => 'basic-calculator',
];
