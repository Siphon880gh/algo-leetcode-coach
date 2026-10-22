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
            'message' => "Problem: A table lists tasks with an employee and start and end times. For each employee, report the total time covered by their tasks, counting overlapping time once, in the unit the statement gives, and the largest number of their tasks running at the same moment. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCovered time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Gaps between events while the running count is positive', 'next' => 's2'],
                ['label' => 'Sum of task lengths', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Overlaps count twice: 9–11 and 10–12 → 4 hours instead of 3.\nStep back to when you added lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Concurrency?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Number of tasks', 'next' => 'wrong_b'],
                ['label' => 'Maximum of the running count', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 9–10 and 11–12 never overlap → 2 instead of 1.\nStep back to when you counted tasks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → 5 hours and 3 at once; 2 hours and 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
