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
            'message' => "Problem: A table lists posts with a user and a date. Within the period the statement gives, report the users whose busiest window of consecutive days (of the length the statement gives) holds at least a stated multiple of their average posts per such window over the period. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWindow bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly less than the length', 'next' => 's2'],
                ['label' => 'Less than or equal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That makes the window one day longer; in the guide’s check it adds user 2.\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare the busiest window with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The multiple times all posts', 'next' => 'wrong_b'],
                ['label' => 'The multiple times the average per window', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the guide’s check, nobody qualifies instead of users 1 and 3.\nStep back to when you used the total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) worst case. The guide’s check → users 1 and 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
