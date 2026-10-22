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
            'message' => "Read the problem statement above.\ns may sit at x’s index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, it needs another index', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [7, 1, −4, −5, 4] → 1 instead of −5.\nStep back to when you allowed the same index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first possible x', 'next' => 'wrong_b'],
                ['label' => 'The largest possible x', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → −2 instead of 4.\nStep back to when you stopped at the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 10, 4, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
