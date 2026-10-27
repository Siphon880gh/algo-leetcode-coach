<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Convert String II',
    'leetcode' => 2977,
    'difficulty' => 'Hard',
    'summary' => 'Floyd-Warshall over the rule strings of each length gives cheapest substring conversions (trie ids make lookups fast). Then dp over positions: copy equal chars for free or convert a whole substring at once.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'tags' => ['trie', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-convert-string-ii',
    'related_session' => 'minimum-cost-to-convert-string-ii',
];
