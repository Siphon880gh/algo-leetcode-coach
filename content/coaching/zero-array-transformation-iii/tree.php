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
            'message' => "Read the problem statement above.\nWhich available query to use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one reaching farthest right', 'next' => 's2'],
                ['label' => 'The one ending soonest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. nums [2, 1], queries [[0, 0], [1, 1], [0, 0], [1, 1], [0, 1]] → 2 instead of 3.\nStep back to when you used the nearest end.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Queries used', 'next' => 'wrong_b'],
                ['label' => 'Queries left unused', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The task asks how many can be removed: example 1 → 2 instead of 1.\nStep back to when you returned the used count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log q). Examples → 1, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
