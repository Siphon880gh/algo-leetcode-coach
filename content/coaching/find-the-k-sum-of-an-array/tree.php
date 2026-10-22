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
            'message' => "Read the problem statement above.\nSubtract subset sums of?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The sorted absolute values', 'next' => 's2'],
                ['label' => 'The sorted values themselves', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Dropping a positive and adding a negative both cost |x|; Example 1 → 4 instead of 2.\nStep back to when you used raw values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Find the (k − 1)-th smallest subset sum how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'List every subset', 'next' => 'wrong_b'],
                ['label' => 'Heap with two pushes per pop', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n reaches 10^5, so there are 2^n subsets.\nStep back to when you listed subsets.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the top sum, popping nothing', 'next' => 'success'],
                ['label' => 'Pop once like any other k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. nums = [2,4,−2], k = 1 → 4 instead of 6.\nStep back to when you popped for k = 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + k log k). Examples → 2, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
