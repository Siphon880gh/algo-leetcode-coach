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
            'message' => "Read the problem statement above.\nSimulate pouring one cup at a time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: track the total that flows through each glass', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Up to 10⁹ cups; only the totals matter.\nStep back to when you poured one cup at a time.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A glass holds amount a > 1. What flows to each glass below?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a / 2', 'next' => 'wrong_b'],
                ['label' => '(a − 1) / 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The glass keeps one cup; only the excess overflows.\nStep back to when you split the whole amount.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(1, amount at the queried glass)', 'next' => 'success'],
                ['label' => 'The amount itself', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A glass holds at most one cup.\nStep back to when you returned the raw amount.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(row²). poured = 1, (1, 1) → 0.0. poured = 2, (1, 1) → 0.5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
