<?php
declare(strict_types=1);

return [
    'title' => 'The Maze III: Dijkstra on (distance, path string) to a hole the ball rolls into',
    'leetcode' => 499,
    'difficulty' => 'Hard',
    'summary' => 'The ball rolls until a wall or until it drops into the hole. Find the shortest roll distance to the hole, breaking ties by the lexicographically smallest u/d/l/r instructions; else "impossible". Dijkstra over stopping cells with the key (distance, path). While rolling, stop early if you reach the hole. Example → "lul". Builds on 490 and 505.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'dijkstra', 'heap', 'matrix', 'leetcode'],
    'related_session' => 'the-maze-iii',
];
