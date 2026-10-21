<?php
declare(strict_types=1);

return [
    'title' => 'The Maze III: Dijkstra on (distance, path string) to a hole the ball rolls into',
    'leetcode' => 499,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: shortest roll to the hole, ties broken by the smallest u/d/l/r string, else "impossible". Dijkstra over stopping cells with key (distance, path). Stop a roll early when it passes the hole. Sample → "lul". Builds on 490 / 505. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graphs', 'dijkstra', 'heap', 'matrix', 'step-by-step'],
    'related_guide' => 'the-maze-iii',
];
