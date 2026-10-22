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
            'message' => "Read the problem statement above.\nScore which stages?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only non-empty bands: S(n, j) splits', 'next' => 's2'],
                ['label' => 'All x stages: x^n · y^x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 18 instead of 6.\nStep back to when you scored empty stages.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stages for j bands?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'C(x, j)', 'next' => 'wrong_b'],
                ['label' => 'x(x − 1)…(x − j + 1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Bands are labelled by performers: example 3 → 220 instead of 684.\nStep back to when you used C(x, j).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · min(n, x)). Examples → 6, 32, 684.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
