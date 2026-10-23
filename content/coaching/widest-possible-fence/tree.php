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
            'message' => "Read the problem statement above.\nPlanks of two different heights?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count them', 'next' => 's2'],
                ['label' => 'Ignore them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 4.\nStep back to when you ignored mixed pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairs (x, h − x)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt[x] · cnt[h − x]', 'next' => 'wrong_b'],
                ['label' => 'min(cnt[x], cnt[h − x])', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 6 instead of 4.\nStep back to when you multiplied the counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m²). Examples → 4, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
