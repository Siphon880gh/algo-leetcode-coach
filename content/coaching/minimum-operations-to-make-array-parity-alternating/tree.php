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
            'message' => "Read the problem statement above.\nMove a wrong element which way?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up if it is the minimum, down if the maximum', 'next' => 's2'],
                ['label' => 'Always up', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [1, 1, 0] → [1, 2] instead of [1, 1].\nStep back to when you always moved up.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The original array', 'next' => 'wrong_b'],
                ['label' => 'The changed array', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [2, 7] instead of [2, 6].\nStep back to when you kept the old range.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [2, 6], [1, 3], [0, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
