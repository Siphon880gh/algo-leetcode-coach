<?php
declare(strict_types=1);

return [
    'title' => 'Counting Sort',
    'summary' => 'For small integer keys 0 to k: count each key, turn counts into prefix sums (prefix[v] = how many keys are at most v), then scan the input from right to left and place each key at index prefix[key] − 1, decreasing prefix[key]. That keeps it stable.',
    'category' => 'Algorithms',
    'subcategory' => 'Sorting',
    'topic' => 'Algorithms · Sorting',
    'tags' => ['sorting', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'counting-sort',
    'related_session' => 'counting-sort',
];
