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
            'message' => "Read the problem statement above.\nWhich values can stay unchanged?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct values only', 'next' => 's2'],
                ['label' => 'All values, duplicates included', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Duplicates break uniqueness, so all but one copy must change.\nStep back to when you kept duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of distinct values', 'next' => 'wrong_b'],
                ['label' => 'The original length n', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. For [1,1,3] that window keeps only one value; with n = 3 it keeps 1 and 3, so the answer is 1.\nStep back to when you used the distinct count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer from the best window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n minus the values it keeps', 'next' => 'success'],
                ['label' => 'The number of values it keeps', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You want the operations, which are the values outside the window.\nStep back to when you returned the kept count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 0, 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
