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
            'message' => "Problem: Given the root of a binary tree, return the level whose node values add up to the smallest sum. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nTies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the shallower level (update on <)', 'next' => 's2'],
                ['label' => 'Update on ≤', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That keeps the deeper tie: the guide’s second check → 3 instead of 2.\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Number levels from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 at the root', 'next' => 'wrong_b'],
                ['label' => '1 at the root', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Under the guide’s assumption the first check → 1 instead of 2.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
