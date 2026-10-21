<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Eaten Apples: eat the soonest to rot',
    'leetcode' => 1705,
    'difficulty' => 'Med',
    'summary' => 'Each day, push that day\'s apples with their rot day into a min-heap; drop rotten or empty batches; eat one from the batch that rots first. Continue after n days while the heap has apples.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'greedy', 'leetcode'],
    'related_session' => 'maximum-number-of-eaten-apples',
];
