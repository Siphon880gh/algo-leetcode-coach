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
            'message' => "Read the problem statement above.\nWhere do the sums start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At 2', 'next' => 's2'],
                ['label' => 'At any prime', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 19 instead of 17.\nStep back to when you allowed other starts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep which sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last one ≤ n', 'next' => 'wrong_b'],
                ['label' => 'The last one ≤ n that is prime', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): n = 12 → 10 instead of 5.\nStep back to when you skipped the prime test.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log log n). Examples → 17, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
