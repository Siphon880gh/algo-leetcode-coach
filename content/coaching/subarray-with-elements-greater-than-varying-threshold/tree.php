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
                ['label' => 'Each element as the minimum of its widest window', 'next' => 's2'],
                ['label' => 'Try every length k with a sliding minimum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With n = 10^5 that is about 10^10 steps.\nStep back to when you tried every k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] · k ≥ threshold', 'next' => 'wrong_b'],
                ['label' => 'nums[i] · k > threshold', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Elements must be strictly greater; nums = [3], threshold = 3 → 1 instead of −1.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width for nums[i] · k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 10^9 · 10^5 = 10^14.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 3 (any valid size is accepted).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
