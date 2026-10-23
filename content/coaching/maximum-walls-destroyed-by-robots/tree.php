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
            'message' => "Read the problem statement above.\nA bullet stops at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The next robot', 'next' => 's2'],
                ['label' => 'Nothing; it passes through', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 1 instead of 0.\nStep back to when bullets passed robots.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Previous fires right, this fires left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add both counts', 'next' => 'wrong_b'],
                ['label' => 'Subtract the walls both hit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Robots [8, 6, 1], distances [4, 5, 3], walls [1, 3, 8, 4] → 6 instead of 4 (only 4 walls exist).\nStep back to when you double-counted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((r + w) log(r + w)). Examples → 1, 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
