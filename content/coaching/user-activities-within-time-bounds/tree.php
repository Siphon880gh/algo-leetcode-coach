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
            'message' => "Problem: A table lists user sessions with a start time, an end time and a session type. Report the users who have two sessions of the same type where the later one starts within the time window the statement gives after the earlier one ends. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nPartition by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'User and session type', 'next' => 's2'],
                ['label' => 'User only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The check also returns 103, whose two sessions differ in type.\nStep back to when you dropped the type.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Gap from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Previous start to this start', 'next' => 'wrong_b'],
                ['label' => 'Previous end to this start', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Add user 104 with V 00:00–14:00 and V 20:00–21:00: the gap is 6 hours, but start to start is 20, so 104 is lost.\nStep back to when you used the start.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The check → 101 (and 104 when added).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
