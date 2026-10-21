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
            'message' => "Read the problem statement above.\nWhich Fibonacci number first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest ≤ k', 'next' => 's2'],
                ['label' => 'Smallest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy largest is optimal.\nStep back to when you took the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Reuse allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No reuse at all', 'next' => 'wrong_b'],
                ['label' => 'Yes, but greedy never needs it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement allows repeats.\nStep back to when you forbade reuse.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "DP over k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not needed', 'next' => 'success'],
                ['label' => 'Required', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. k can be large; greedy is O(log k).\nStep back to when you chose DP.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log k). k = 7 → 2. k = 10 → 2. k = 19 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
