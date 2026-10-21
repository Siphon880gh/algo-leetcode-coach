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
            'message' => "Read the problem statement above.\nAfter using a value's indices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Delete the list', 'next' => 's2'],
                ['label' => 'Keep it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Long equal runs would be rescanned and BFS turns quadratic.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Allow i − 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'wrong_b'],
                ['label' => 'Yes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Moving back can be on the shortest path.\nStep back to when you forbade it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Single element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 steps', 'next' => 'success'],
                ['label' => '1 step', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You start at the last index.\nStep back to when you counted a step.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). First example → 3. [7] → 0. [7,6,9,6,9,6,9,7] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
