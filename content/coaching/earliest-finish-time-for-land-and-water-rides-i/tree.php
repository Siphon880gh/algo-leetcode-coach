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
            'message' => "Read the problem statement above.\nOrders to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Land first and water first', 'next' => 's2'],
                ['label' => 'Land first only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 18 instead of 14.\nStep back to when you fixed the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The second ride starts at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first finish', 'next' => 'wrong_b'],
                ['label' => 'max(first finish, its opening time)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Land [1] lasting 1, water [5] lasting 1 → 3 instead of 6.\nStep back to when you ignored the opening time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m). Examples → 9, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
