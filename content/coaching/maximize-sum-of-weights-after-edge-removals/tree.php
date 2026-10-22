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
            'message' => "Read the problem statement above.\nPer node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Best gains w + keep0 − keep1 over children', 'next' => 's2'],
                ['label' => 'The k heaviest edges', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Edges 1–0 (6), 2–0 (7), 3–1 (1), k = 1 → 7 instead of 8.\nStep back to when you took the heaviest edges.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which gains?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Top k, even negative', 'next' => 'wrong_b'],
                ['label' => 'Top k, positive only', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Edges 1–0 (5), 2–1 (9), 3–1 (6), k = 2 → 14 instead of 15.\nStep back to when you kept a negative gain.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 22, 65.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
