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
            'message' => "Read the problem statement above.\nA pair counts when the sum is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '< target', 'next' => 's2'],
                ['label' => '≤ target', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Equal sums are not less; example 1 → 5 instead of 3.\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "a[i] + a[j] < target, add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => 'j − i', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every element between pairs with a[i]; example 1 → 1 instead of 3.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
