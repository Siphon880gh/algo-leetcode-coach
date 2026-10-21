<?php
declare(strict_types=1);

return [
    'title' => 'The Time When the Network Becomes Idle: BFS distance plus resend math',
    'leetcode' => 2039,
    'difficulty' => 'Med',
    'summary' => 'BFS from the master gives each server its distance d; a round trip takes t = 2d. The server resends every patience[i] seconds until the first reply, so its last send is at ((t − 1) // p) · p and it goes idle at that time + t + 1. Take the maximum.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['graph', 'bfs', 'math', 'leetcode'],
    'related_session' => 'the-time-when-the-network-becomes-idle',
];
