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
            'message' => "Read the problem statement above.\nPer run of length L?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L(L + 1)/2', 'next' => 's2'],
                ['label' => 'L', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every sub-run counts.\nStep back to when you added L once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At a 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the run', 'next' => 'wrong_b'],
                ['label' => 'Reset the run to 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A 0 breaks the run.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Overflow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit before mod', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. L can reach 10^5.\nStep back to when you used 32 bits.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"0110111\" → 9. \"101\" → 2. \"111111\" → 21.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
