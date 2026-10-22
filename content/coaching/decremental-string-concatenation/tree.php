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
            'message' => "Read the problem statement above.\nChoose a join order how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP over (first, last) letters', 'next' => 's2'],
                ['label' => 'Greedily take the shorter join', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A tie can hide a later overlap; [a, b, ab] with ties to the first option → 4 instead of 3.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "join(x, y) overlaps when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Their first letters match', 'next' => 'wrong_b'],
                ['label' => 'The last letter of x equals the first of y', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only the touching letters can merge; example 1 → 5 instead of 4.\nStep back to when you compared first letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 26²). Examples → 4, 2, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
