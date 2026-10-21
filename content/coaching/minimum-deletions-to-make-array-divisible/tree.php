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
            'message' => "Read the problem statement above.\nTest a candidate against?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The gcd of numsDivide', 'next' => 's2'],
                ['label' => 'Every element of numsDivide', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With 10^5 candidates and 10^5 elements that is 10^10 checks.\nStep back to when you tested every element.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count deletions how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Index of the first divisor in the original order', 'next' => 'wrong_b'],
                ['label' => 'Index of the first divisor in sorted nums', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Smaller values after it still need deleting; Example 1 → 1 instead of 2.\nStep back to when you used the original order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No element divides the gcd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return the length of nums', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Deleting everything leaves no minimum; Example 2 → 3 instead of −1.\nStep back to when you returned the length.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + m log(max)). Examples → 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
