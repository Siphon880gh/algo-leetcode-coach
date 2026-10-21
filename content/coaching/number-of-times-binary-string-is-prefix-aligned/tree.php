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
            'message' => "Read the problem statement above.\nSimulate the string each step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: track the max', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Checking the prefix each step is O(n²).\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Aligned when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'flips[i] == i', 'next' => 'wrong_b'],
                ['label' => 'max == i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Earlier flips may still leave gaps.\nStep back to when you compared the current flip.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Step index base?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1-based like the positions', 'next' => 'success'],
                ['label' => '0-based', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Steps and positions must align.\nStep back to when you mixed bases.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [3,2,4,1,5] → 2. [4,1,2,3] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
