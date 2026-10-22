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
            'message' => "Read the problem statement above.\nFirst press takes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its own time', 'next' => 's2'],
                ['label' => '0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 1 instead of 10.\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ties?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First seen', 'next' => 'wrong_b'],
                ['label' => 'Smaller index', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[5, 3], [2, 6]] → 5 instead of 2.\nStep back to when you kept the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
