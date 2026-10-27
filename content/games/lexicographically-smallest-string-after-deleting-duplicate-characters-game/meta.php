<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Smallest String After Deleting Duplicate Characters',
    'leetcode' => 3816,
    'difficulty' => 'Hard',
    'summary' => 'Monotonic stack with letter counts (in the stack plus still to come). Before pushing c, pop tops that are larger than c while another copy of that letter survives elsewhere. At the end, drop trailing letters that still have a copy earlier, since a shorter prefix is smaller.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'lexicographically-smallest-string-after-deleting-duplicate-characters',
    'related_session' => 'lexicographically-smallest-string-after-deleting-duplicate-characters',
];
