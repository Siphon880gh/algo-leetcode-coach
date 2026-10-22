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
            'message' => "Read the problem statement above.\nWhich two chocolates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two cheapest', 'next' => 's2'],
                ['label' => 'The first two', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Cheaper ones may come later; [3, 1, 1] with money 3 → 3 instead of 1.\nStep back to when you took the first two.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The cheapest pair costs more than money?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return money minus the pair anyway', 'next' => 'wrong_b'],
                ['label' => 'Return money', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Leftover must not be negative; example 2 → −2 instead of 3.\nStep back to when you went into debt.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 0, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
