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
            'message' => "Read the problem statement above.\nRecompute the even sum after every query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: adjust it with the changed element only', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · q).\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The old value was even. Before the update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave the sum alone', 'next' => 'wrong_b'],
                ['label' => 'Subtract it from the sum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The old value no longer exists after the update.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is −4 even?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Negative even numbers count too.\nStep back to when you skipped negatives.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). nums = [1,2,3,4], queries = [[1,0],[−3,1],[−4,0],[2,3]] → [8,6,2,4]. nums = [1], queries = [[4,0]] → [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
