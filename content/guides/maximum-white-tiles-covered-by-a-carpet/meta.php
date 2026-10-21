<?php
declare(strict_types=1);

return [
    'title' => 'Maximum White Tiles Covered by a Carpet: start at a tile, slide the window',
    'leetcode' => 2271,
    'difficulty' => 'Med',
    'summary' => 'Sort the tiles. Some best placement starts at a tile’s left end, so for each tile i put the carpet at l_i, count fully covered tiles with a moving right pointer and add the partial overlap of the next tile.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'greedy', 'sorting', 'prefix-sum', 'sliding-window', 'leetcode'],
    'related_session' => 'maximum-white-tiles-covered-by-a-carpet',
];
