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
            'message' => "Read the problem statement above.\nPair the smallest value with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The large half, with a second pointer', 'next' => 's2'],
                ['label' => 'The nearest larger value that works', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Nearby partners steal the big values; nums = [1,2,3,4] → 2 instead of 4.\nStep back to when you paired neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pair when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 · a[i] < a[j]', 'next' => 'wrong_b'],
                ['label' => '2 · a[i] ≤ a[j]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equality is allowed; nums = [1,2] → 0 instead of 2.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
