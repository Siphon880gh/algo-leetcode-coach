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
            'message' => "Read the problem statement above.\nStart where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bottom-left', 'next' => 's2'],
                ['label' => 'Top-left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. From the top-left, moving right and moving down both decrease the value, so neither move rules anything out.\nStep back to when you started top-left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Negative found at column j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add 1, move right', 'next' => 'wrong_b'],
                ['label' => 'Add n − j, move up', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The rest of the row is negative too.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is 0 negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only values below 0 count.\nStep back to when you counted 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + n). First example → 8. [[3,2],[1,0]] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
