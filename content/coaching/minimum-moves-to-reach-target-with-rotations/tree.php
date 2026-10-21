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
            'message' => "Read the problem statement above.\nState?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(tail row, tail column, orientation)', 'next' => 's2'],
                ['label' => 'Tail cell only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One cell can hold the snake in two orientations.\nStep back to when you dropped the orientation.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rotate a horizontal snake clockwise when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The cell below the tail is free', 'next' => 'wrong_b'],
                ['label' => 'Both cells below it are free', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The rotation sweeps both cells below.\nStep back to when you checked one cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Target state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(n − 1, n − 2, horizontal)', 'next' => 'success'],
                ['label' => '(n − 1, n − 1, any)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The snake must lie horizontally in the last two cells.\nStep back to when you used the corner.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Example 1 → 11. Example 2 → 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
