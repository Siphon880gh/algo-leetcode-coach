<?php
declare(strict_types=1);

return [
    'title' => 'Find Substring With Given Hash Value',
    'leetcode' => 2156,
    'difficulty' => 'Hard',
    'summary' => 'hash(s[i..i+k)) = Σ val(s[i+j]) · power^j mod m. Roll from the right end leftward (multiply by power, add the new char, drop the outgoing one times power^k); keep the leftmost match.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-substring-with-given-hash-value',
    'related_session' => 'find-substring-with-given-hash-value',
];
