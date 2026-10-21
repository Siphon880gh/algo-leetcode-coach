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
            'message' => "Read the problem statement above.\nSimulate collisions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: swapping labels changes nothing', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Positions over time are identical without bouncing.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Time for a right-mover at p?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p', 'next' => 'wrong_b'],
                ['label' => 'n − p', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It walks to the right end.\nStep back to when you used p.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Empty left or right list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Treat its max as 0', 'next' => 'success'],
                ['label' => 'Error', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 has no left ants.\nStep back to when you errored.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 4, left [4,3], right [0,1] → 4. All right from 0..7 → 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
