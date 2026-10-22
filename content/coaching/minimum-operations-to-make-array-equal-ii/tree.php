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
            'message' => "Read the problem statement above.\nk = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0 if the arrays are equal, else −1', 'next' => 's2'],
                ['label' => 'Go straight to d mod k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Modulo by 0 fails; nums1 = nums2 = [1,2], k = 0 crashes instead of returning 0.\nStep back to when you skipped the guard.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Number of operations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ |d| / k', 'next' => 'wrong_b'],
                ['label' => 'Positive surplus / k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each operation fixes one surplus and one deficit together; Example 1 → 4 instead of 2.\nStep back to when you added both sides.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
