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
            'message' => "Read the problem statement above.\nMultiply the values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: track signs only', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Products overflow quickly.\nStep back to when you multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Negative number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset both', 'next' => 'wrong_b'],
                ['label' => 'pos, neg = neg + 1 (if neg), pos + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two negatives make a positive.\nStep back to when you reset.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Zero?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset both to 0', 'next' => 'success'],
                ['label' => 'Skip it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any subarray containing 0 has product 0.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,-2,-3,4] → 4. [0,1,-2,-3,-4] → 3. [-1,-2,-3,0,1] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
