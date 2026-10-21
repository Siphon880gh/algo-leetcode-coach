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
            'message' => "Read the problem statement above.\nDistance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS shortest path', 'next' => 's2'],
                ['label' => 'Manhattan distance', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Walls force detours, so Manhattan distance can be too short.\nStep back to when you used Manhattan distance.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ranking order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Price first', 'next' => 'wrong_b'],
                ['label' => 'Distance, then price, then row, then col', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 would rank (2,1) before (1,1), giving [[0,1],[2,1],[1,1]].\nStep back to when you ranked by price first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cells with value 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walls: never enter them', 'next' => 'success'],
                ['label' => 'Walk through them as free cells', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 0 is a wall, so paths through it do not exist.\nStep back to when you entered a wall.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n log(m · n)). Examples → [[0,1],[1,1],[2,1]], [[2,1],[1,2]], [[2,1],[2,0]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
