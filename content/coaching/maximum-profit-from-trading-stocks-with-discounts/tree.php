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
            'message' => "Read the problem statement above.\nDiscount?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Half price when the direct boss buys', 'next' => 's2'],
                ['label' => 'No discount', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 4 instead of 5.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Who gets the discount?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Anyone below a buyer', 'next' => 'wrong_b'],
                ['label' => 'Only direct reports of a buyer', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 3, present = [1, 8, 7], future = [2, 7, 8], hierarchy = [[1, 2], [2, 3]], budget = 6 → 6 instead of 4.\nStep back to when you passed it further down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · budget²). Examples → 5, 4, 10, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
