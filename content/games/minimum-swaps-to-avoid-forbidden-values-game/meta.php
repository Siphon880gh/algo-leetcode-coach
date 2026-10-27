<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Swaps to Avoid Forbidden Values',
    'leetcode' => 3785,
    'difficulty' => 'Hard',
    'summary' => 'Impossible if some value v appears in nums more often than the positions that do not forbid v. Otherwise let m be the bad positions (nums[i] = forbidden[i]) and c the largest group of bad positions sharing a value: pair up different bad values (⌈m/2⌉ swaps) unless one value dominates, giving max(⌈m/2⌉, c).',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-swaps-to-avoid-forbidden-values',
    'related_session' => 'minimum-swaps-to-avoid-forbidden-values',
];
