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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start from all zeros together', 'next' => 's2'],
                ['label' => 'BFS from each 1 to find its nearest 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. BFS from each 1 is O((m n)²).\nStep back to when you searched from every 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Queue has all zeros.\nWhen do you set a neighbor?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every time you reach it, take the min and push again', 'next' => 'wrong_b'],
                ['label' => 'Only when it is still unknown (−1): set d + 1 and push', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. BFS reaches each cell first along a shortest route; later visits are never shorter. Updating again wastes work.\nStep back to when you re-pushed visited cells.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Each cell is set once: O(m n). DP alternative: top-left pass then bottom-right pass.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multi-source BFS, or two opposite sweeps', 'next' => 'success'],
                ['label' => 'One top-left DP pass', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One DP pass only sees up and left. A zero below or right is missed.\nStep back to when you did a single pass.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. All zeros as sources, set each cell once. → [[0,0,0],[0,1,0],[1,2,1]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
