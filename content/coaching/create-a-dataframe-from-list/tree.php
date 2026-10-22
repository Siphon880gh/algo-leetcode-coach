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
            'message' => "Read the problem statement above.\nBuild with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pd.DataFrame(student_data, ...)', 'next' => 's2'],
                ['label' => 'pd.Series(student_data)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A Series holds each pair as one value; shape (4,) instead of two columns.\nStep back to when you used a Series.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Column names?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave them out', 'next' => 'wrong_b'],
                ['label' => 'columns=[student_id, age]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. pandas names them 0 and 1.\nStep back to when you omitted columns.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Four rows: (1, 15), (2, 11), (3, 11), (4, 20).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
