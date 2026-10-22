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
            'message' => "Read the problem statement above.\nUpdate how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS again', 'next' => 's2'],
                ['label' => 'Subtract v − u − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [3, 2, −1] instead of [3, 2, 1].\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which roads?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the newest', 'next' => 'wrong_b'],
                ['label' => 'Every road so far', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [3, 3, 1] instead of [3, 2, 1].\nStep back to when you dropped older roads.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q (n + q)). Examples → [3, 2, 1], [1, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
