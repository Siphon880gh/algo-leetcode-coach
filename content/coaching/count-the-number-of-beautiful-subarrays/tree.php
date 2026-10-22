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
            'message' => "Read the problem statement above.\nBeautiful when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The XOR is 0', 'next' => 's2'],
                ['label' => 'The sum is even', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every bit needs an even count, not just the total; Example 1 → 10 instead of 2.\nStep back to when you used the sum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "seen starts as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Empty', 'next' => 'wrong_b'],
                ['label' => '{0: 1}', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Subarrays starting at index 0 are missed; Example 1 → 1 instead of 2.\nStep back to when you left it empty.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
