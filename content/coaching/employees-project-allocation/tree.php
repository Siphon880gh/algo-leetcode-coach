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
            'message' => "Problem: One table lists project assignments with an employee and a workload; another gives each employee’s name and team. Report the assignments whose workload is higher than the average workload of the employee’s team. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nAverage over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The team’s assignments', 'next' => 's2'],
                ['label' => 'All assignments', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The overall average 64.8 drops the 62.\nStep back to when you averaged everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Not over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, own assignments are fine', 'next' => 'wrong_b'],
                ['label' => 'The employee’s own assignments', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Then only John’s 100 qualifies; Ali’s 90 and Doe’s 62 drop.\nStep back to when you averaged per employee.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The check → 62, 90, 100.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
