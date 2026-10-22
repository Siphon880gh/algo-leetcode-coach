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
            'message' => "Read the problem statement above.\nPlan?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counter of reduced fractions', 'next' => 's2'],
                ['label' => 'Check every 4-tuple', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With n = 1000 that is C(1000, 4) ≈ 4.1 · 10^10 tuples.\nStep back to when you tried every tuple.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Index gaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any increasing indices', 'next' => 'wrong_b'],
                ['label' => 'At least one index between each pair', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 18 instead of 3.\nStep back to when you ignored the gaps.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² log V). Examples → 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
