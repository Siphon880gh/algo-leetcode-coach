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
            'message' => "Read the problem statement above.\nHow do the segment lengths grow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By one after every two segments', 'next' => 's2'],
                ['label' => 'By one after every segment', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The spiral goes 1 east, 1 south, then 2 west, 2 north.\nStep back to when you grew every turn.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The walk leaves the grid. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop', 'next' => 'wrong_b'],
                ['label' => 'Keep walking but do not record', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The spiral comes back into the grid later.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When are you done?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When rows · cols cells are recorded', 'next' => 'success'],
                ['label' => 'When the spiral returns to the start', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A spiral never returns to its start.\nStep back to when you waited for the start.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(max(rows, cols)²). rows = 1, cols = 4, start (0, 0) → [[0,0],[0,1],[0,2],[0,3]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
