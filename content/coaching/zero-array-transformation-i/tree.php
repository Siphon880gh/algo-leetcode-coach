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
            'message' => "Read the problem statement above.\nCheck?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Coverage at each index', 'next' => 's2'],
                ['label' => 'Total sum against total query length', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [0, 2] with [[0, 0], [0, 0]] → true instead of false.\nStep back to when you compared totals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Coverage via?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Loop over each range', 'next' => 'wrong_b'],
                ['label' => 'Difference array', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Up to 10^5 · 10^5 = 10^10 steps.\nStep back to when you looped over ranges.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
