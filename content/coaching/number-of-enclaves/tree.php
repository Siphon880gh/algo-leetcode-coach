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
            'message' => "Read the problem statement above.\nSearch from each land cell for the border?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: start from the border and flood inward', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That repeats work for every cell.\nStep back to when you searched from each cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which neighbours count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All eight', 'next' => 'wrong_b'],
                ['label' => 'Up, down, left, right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Moves are 4-directional.\nStep back to when you used diagonals.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After the flood, what do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of 1s left', 'next' => 'success'],
                ['label' => 'The number of islands left', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The question asks for cells, not islands.\nStep back to when you counted islands.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). [[0,0,0,0],[1,0,1,0],[0,1,1,0],[0,0,0,0]] → 3. [[0,1,1,0],[0,0,1,0],[0,0,1,0],[0,0,0,0]] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
