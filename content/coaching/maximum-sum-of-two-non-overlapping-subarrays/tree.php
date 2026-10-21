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
            'message' => "Read the problem statement above.\nAssume firstLen always comes first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: try both orders', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The better split may put secondLen first.\nStep back to when you fixed the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you carry during the sweep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The left window right next to it', 'next' => 'wrong_b'],
                ['label' => 'The best left-window sum ending before the right window', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The best left window may be farther left.\nStep back to when you used the adjacent window.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you get a window sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'P[end] − P[start]', 'next' => 'success'],
                ['label' => 'Add its elements each time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That makes the sweep O(n · L).\nStep back to when you added elements.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [0,6,5,2,2,5,1,9,4], 1, 2 → 20. [3,8,1,3,2,1,8,9,0], 3, 2 → 29. [2,1,5,6,0,9,5,0,3,8], 4, 3 → 31.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
