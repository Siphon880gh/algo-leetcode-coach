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
            'message' => "Read the problem statement above.\nHow many deletions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any number of disjoint blocks', 'next' => 's2'],
                ['label' => 'Just one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [5, 3, 4, 1], k = 5 → 8 instead of 3.\nStep back to when you allowed one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "best[p] keeps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first f seen at remainder p', 'next' => 'wrong_b'],
                ['label' => 'The smallest f seen at remainder p', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [6, 4, 1, 5, 2, 5], k = 5 → 8 instead of 3.\nStep back to when you kept the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
