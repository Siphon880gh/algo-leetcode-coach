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
            'message' => "Read the problem statement above.\nA drop from i − 1 to i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Free: extend earlier operations', 'next' => 's2'],
                ['label' => 'Costs the difference', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Shorter ranges cover the lower value.\nStep back to when you charged drops.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Free', 'next' => 'wrong_b'],
                ['label' => 'Costs target[0]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It starts from 0.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Simulate levels?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: O(n) formula', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Values up to 10^5 make that slow.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,2,1] → 3. [3,1,1,2] → 4. [3,1,5,4,2] → 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
