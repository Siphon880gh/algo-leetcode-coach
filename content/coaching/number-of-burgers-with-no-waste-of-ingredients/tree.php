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
            'message' => "Read the problem statement above.\nSearch over all counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: solve the system', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two linear equations give one solution.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "T is odd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Round down', 'next' => 'wrong_b'],
                ['label' => 'Return []', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every burger uses an even number of tomato slices.\nStep back to when you rounded.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "j or s negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return []', 'next' => 'success'],
                ['label' => 'Clamp to 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Clamping would waste ingredients.\nStep back to when you clamped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). (16, 7) → [1,6]. (17, 4) → []. (4, 17) → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
