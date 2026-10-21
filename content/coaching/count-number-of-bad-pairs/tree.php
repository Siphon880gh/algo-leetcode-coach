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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count good pairs and subtract', 'next' => 's2'],
                ['label' => 'Check every pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 10^5 gives about 5 · 10^9 pairs.\nStep back to when you checked every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Good-pair key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] + i', 'next' => 'wrong_b'],
                ['label' => 'nums[i] − i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 6 instead of 5.\nStep back to when you added the index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Up to 4,999,950,000 bad pairs.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
