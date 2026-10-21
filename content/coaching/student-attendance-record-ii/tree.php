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
            'message' => "Read the problem statement above.\nn is up to 1e5. List all records?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count them with DP', 'next' => 's2'],
                ['label' => 'Yes: generate and filter all 3^n strings', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 3^n explodes long before n = 1e5.\nStep back to when you generated every string.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What must a state remember?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the total number of L', 'next' => 'wrong_b'],
                ['label' => 'Absences so far (0 or 1) and the current run of trailing L (0, 1 or 2)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Lates only fail in a row, so you need the trailing run, not the total.\nStep back to when you counted all L.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Adding a day: how do the 6 states move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'P resets the L run; A needs a = 0 and resets the run; L needs run < 2 and adds 1', 'next' => 'success'],
                ['label' => 'A keeps the L run going', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An A is not an L, so it breaks the run of lates.\nStep back to when you kept the run after an A.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Six states, one transition per day, sum mod 1e9 + 7: O(n) time, O(1) space. n = 2 → 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
