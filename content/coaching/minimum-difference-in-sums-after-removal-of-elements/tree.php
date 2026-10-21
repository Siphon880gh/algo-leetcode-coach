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
            'message' => "Read the problem statement above.\nWhere can the split be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any i from n to 2n', 'next' => 's2'],
                ['label' => 'Only at n, after the first third', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The removed elements can sit anywhere; Example 2 → 1 needs a later split.\nStep back to when you fixed the split.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Left side heap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Min-heap', 'next' => 'wrong_b'],
                ['label' => 'Max-heap, evicting the largest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. To keep the n smallest you must drop the largest, which a min-heap cannot reach.\nStep back to when you chose a min-heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Right side keeps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The n largest', 'next' => 'success'],
                ['label' => 'The n smallest', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. sum_second is subtracted, so it should be as large as possible.\nStep back to when you kept the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → −1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
