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
            'message' => "Problem: One table lists user activities (sending or opening snaps) with the time spent; another gives each user’s age group. For each age group, report the percentage of total time spent on each activity type, rounded as the statement asks. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWeigh by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Time spent', 'next' => 's2'],
                ['label' => 'Number of rows', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The check gives X → 50.0 instead of 59.38.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Denominator?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Everyone’s total time', 'next' => 'wrong_b'],
                ['label' => 'The group’s total time', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The check gives X → 38.0 instead of 59.38.\nStep back to when you used the overall total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The check → X 59.38, Y 66.67 for sending.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
