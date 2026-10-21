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
            'message' => "Read the problem statement above.\nTry all 3ⁿ assignments?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: DP keyed by the height difference', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With n = 20, 3²⁰ is about 3.5 billion.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Adding rod r to the shorter side, with difference d and shorter s. New shorter side?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's + r', 'next' => 'wrong_b'],
                ['label' => 's + min(d, r)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. If r > d, the old taller side becomes the shorter one, at s + d.\nStep back to when you used s + r.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which entry is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The shorter side at difference 0', 'next' => 'success'],
                ['label' => 'The largest shorter side overall', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The two supports must be equal.\nStep back to when you took the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · sum). [1,2,3,6] → 6. [1,2,3,4,5,6] → 10. [1,2] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
