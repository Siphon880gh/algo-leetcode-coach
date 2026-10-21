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
            'message' => "Read the problem statement above.\nDoes the sign of target matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: mirror it and use |target|', 'next' => 's2'],
                ['label' => 'Yes: handle negatives separately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The moves are symmetric.\nStep back to when you split on the sign.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "sum ≥ target but sum − target is odd. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return k', 'next' => 'wrong_b'],
                ['label' => 'Keep adding steps until the excess is even', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Flipping a step changes the sum by an even amount, so an odd excess cannot be removed.\nStep back to when you returned k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many extra steps can that take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most 2', 'next' => 'success'],
                ['label' => 'Unbounded', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Adding k + 1 and k + 2 covers both parities.\nStep back to when you expected many.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√target). target = 2 → 3. target = 3 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
