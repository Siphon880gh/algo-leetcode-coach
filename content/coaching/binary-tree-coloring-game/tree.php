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
            'message' => "Read the problem statement above.\nSimulate the game?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: pick a neighbour of x and own its region', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The best move blocks one side of x.\nStep back to when you simulated turns.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Regions to compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only left(x) and right(x)', 'next' => 'wrong_b'],
                ['label' => 'left(x), right(x), n − 1 − left − right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The parent side is a region too.\nStep back to when you left out the parent.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Win condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Some region > n / 2', 'next' => 'success'],
                ['label' => 'Some region ≥ n / 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A tie is not a win, and n is odd.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1..11], n = 11, x = 3 → true. [1,2,3], n = 3, x = 1 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
