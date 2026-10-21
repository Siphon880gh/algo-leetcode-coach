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
            'message' => "Read the problem statement above.\nAll subarrays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the AND set stays ~20 values', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. O(n²) is too slow for 10^5.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why so small?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values are bounded by n', 'next' => 'wrong_b'],
                ['label' => 'Each distinct value drops bits', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It is about bits, not n.\nStep back to when you used n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Early exit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the difference is 0', 'next' => 'success'],
                ['label' => 'Never', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 0 cannot be improved.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). [9,12,3,7,15], 5 → 2. [1,2,4,8,16], 0 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
