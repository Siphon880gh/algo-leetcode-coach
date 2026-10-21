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
            'message' => "Read the problem statement above.\nTime between two points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(|dx|, |dy|)', 'next' => 's2'],
                ['label' => '|dx| + |dy|', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Diagonal moves cover both axes at once.\nStep back to when you used Manhattan distance.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Visit order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any order', 'next' => 'wrong_b'],
                ['label' => 'The given order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The points must be visited in order.\nStep back to when you reordered.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sum over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Consecutive pairs', 'next' => 'success'],
                ['label' => 'All pairs', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only the path legs count.\nStep back to when you summed all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [[1,1],[3,4],[-1,0]] → 7. [[3,2],[-2,2]] → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
