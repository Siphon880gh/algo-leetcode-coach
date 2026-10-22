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
            'message' => "Read the problem statement above.\nWhat size of answer to look for?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One zero row, or two rows', 'next' => 's2'],
                ['label' => 'Search every subset of rows', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With up to 10^4 rows there are 2^10000 subsets.\nStep back to when you searched all subsets.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two rows form a good pair when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Their masks differ', 'next' => 'wrong_b'],
                ['label' => 'Their masks AND to 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Different rows can still share a 1; [[0,1,1],[1,1,0]] → [0, 1] instead of [].\nStep back to when you checked only that they differ.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · 2^n). Examples → [0, 1], [0], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
