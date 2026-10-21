<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Read the problem statement above.\nBuild the subdivided graph explicitly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep the original nodes with edge weight cnt + 1', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It can have up to 10⁸ nodes.\nStep back to when you expanded the edges.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many new nodes on edge (u, v, cnt) are reachable?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(0, M − dist[u])', 'next' => 'wrong_b'],
                ['label' => 'min(cnt, max(0, M − dist[u]) + max(0, M − dist[v]))', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The edge can be entered from both ends.\nStep back to when you counted one end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why cap at cnt?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'So the two ends do not count the same middle nodes twice', 'next' => 'success'],
                ['label' => 'It is not needed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. When both ends reach far, their walks overlap.\nStep back to when you dropped the cap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(E log V). edges = [[0,1,10],[0,2,1],[1,2,2]], maxMoves = 6, n = 3 → 13. edges = [[0,1,4],[1,2,6],[0,2,8],[1,3,1]], maxMoves = 10, n = 4 → 23. edges = [[1,2,4],[1,4,5],[1,3,1],[2,3,4],[3,4,5]], maxMoves = 17, n = 5 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
