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
            'message' => "Read the problem statement above.\nn reaches 10^5. Approach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sliding window', 'next' => 's2'],
                ['label' => 'Every subarray', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 5 · 10^9 subarrays.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shrink while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count ≥ k', 'next' => 'wrong_b'],
                ['label' => 'count > k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. k copies are allowed; example 1 → 3 instead of 6.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
