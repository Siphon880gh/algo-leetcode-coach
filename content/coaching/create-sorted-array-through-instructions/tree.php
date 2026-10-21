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
            'message' => "Read the problem statement above.\nData structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fenwick tree over values', 'next' => 's2'],
                ['label' => 'Sorted list with insort', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. insort is O(n) per insert in the worst case.\nStep back to when you used insort.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Greater count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'inserted − query(x − 1)', 'next' => 'wrong_b'],
                ['label' => 'inserted − query(x)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts equal values as greater.\nStep back to when you used x − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Neither less nor greater', 'next' => 'success'],
                ['label' => 'Count as less', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal elements are strictly excluded.\nStep back to when you counted them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log V). Examples → 1, 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
