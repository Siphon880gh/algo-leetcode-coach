<?php
declare(strict_types=1);

return [
    'title' => 'Word Ladder II',
    'leetcode' => 126,
    'difficulty' => 'Hard',
    'summary' => 'BFS from the begin word layer by layer, recording every parent on a shortest route. Stop at the layer that reaches the end word, then backtrack from it through the parents to list all shortest ladders.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'word-ladder-ii',
    'related_session' => 'word-ladder-ii',
];
