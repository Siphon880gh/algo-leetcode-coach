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
            'message' => "Read the problem statement above.\nFind student 101 with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'students[student_id] == 101 as a mask', 'next' => 's2'],
                ['label' => 'students.loc[101]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. loc looks up the index label, not student_id; it raises KeyError.\nStep back to when you used the label.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Select columns with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A single column name', 'next' => 'wrong_b'],
                ['label' => 'A list: [name, age]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A single column name returns a Series, not a DataFrame.\nStep back to when you selected one name.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The example → Ulysses, 13.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
