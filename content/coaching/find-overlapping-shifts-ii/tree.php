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
            'message' => "Problem: A table lists employees’ shifts with start and end date-times. For each employee, report the largest number of shifts that overlap at one time and the total overlap time between pairs of shifts, in the format the statement asks. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nMax overlap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Maximum running sum of events', 'next' => 's2'],
                ['label' => 'Number of shifts', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check employee 2 → 2 instead of 1.\nStep back to when you counted shifts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal times?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Starts before ends', 'next' => 'wrong_b'],
                ['label' => 'Ends before starts', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Shifts 09–12 and 12–15 then reach 2 instead of 1.\nStep back to when you put starts first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. The guide’s check → (1: 3, 420), (2: 1, 0).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
