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
            'message' => "Read the problem statement above.\nCan you choose the order of cutting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: shortest to tallest, so sort the trees by height', 'next' => 's2'],
                ['label' => 'Yes: find the shortest tour', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The order is forced; this is not a traveling-salesman problem.\nStep back to when you chose the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you get from one tree to the next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Manhattan distance', 'next' => 'wrong_b'],
                ['label' => 'BFS on the grid through non-zero cells', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Obstacles (0 cells) can force detours.\nStep back to when you used Manhattan distance.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Do cut trees block later paths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: trees are always walkable, so the grid never changes', 'next' => 'success'],
                ['label' => 'Yes: update the grid after each cut', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You may walk through trees without cutting them, and a cut tree is ground.\nStep back to when you updated the grid.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sorted targets plus a BFS per leg: O(T · m · n). [[1,2,3],[0,0,4],[7,6,5]] → 6. [[1,2,3],[0,0,0],[7,6,5]] → -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
