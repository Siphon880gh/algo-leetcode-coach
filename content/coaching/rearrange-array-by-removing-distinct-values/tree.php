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
            'message' => "Read the problem statement above.\nIs the answer just nums sorted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_a'],
                ['label' => 'No, each round takes one copy of each value left', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Sorting gives [1, 1, 2, 3, 3, 3] instead of [1, 2, 3, 1, 3, 3] for Example 1.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 2, [7, 7, 4, 4, 4]. What does round 3 append?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4', 'next' => 'success'],
                ['label' => '4, 7', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both 7s are used in rounds 1 and 2, so only one 4 is left for round 3.\nStep back to when you appended 7 again.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Counting rounds. O(n · m). Examples give [1, 2, 3, 1, 3, 3] and [4, 7, 4, 7, 4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
