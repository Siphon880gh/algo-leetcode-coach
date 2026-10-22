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
            'message' => "Read the problem statement above.\nNext row id?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A per-table counter that never goes back', 'next' => 's2'],
                ['label' => 'Number of rows + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. After ins, ins, rmv 1, the next ins gets id 2 and overwrites the existing row 2 instead of getting id 3.\nStep back to when you reused the row count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A row of the wrong length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Insert it anyway and return true', 'next' => 'wrong_b'],
                ['label' => 'Return false and insert nothing', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement says it must return false with no insertion, and the id must not advance.\nStep back to when you inserted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "sel with an out-of-range column?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return <null>', 'next' => 'success'],
                ['label' => 'Index the row directly', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That fails or reads past the row; every index must be checked first.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(row length) per call. Both examples’ call sequences → the expected outputs.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
