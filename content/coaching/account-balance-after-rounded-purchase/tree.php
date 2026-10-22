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
            'message' => "Read the problem statement above.\nRound p with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(p + 5) // 10 · 10', 'next' => 's2'],
                ['label' => 'p // 10 · 10', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That always rounds down; example 1 → 100 instead of 90.\nStep back to when you floored.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Use the language’s round(p / 10)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, add 5 and floor', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Python rounds 2.5 to 2; p = 25 → 80 instead of 70.\nStep back to when you used round.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 90, 80, 90.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
