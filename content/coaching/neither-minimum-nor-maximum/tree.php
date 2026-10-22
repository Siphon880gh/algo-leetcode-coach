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
            'message' => "Read the problem statement above.\nFewer than three numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 's2'],
                ['label' => 'Return the first number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With two numbers each is the min or the max; example 2 → 1 instead of −1.\nStep back to when you returned a number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which of three numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first one', 'next' => 'wrong_b'],
                ['label' => 'The middle one after sorting them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It can be the minimum; [1, 2, 3] → 1.\nStep back to when you took the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 2, −1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
