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
            'message' => "Problem: A votes table records which candidate each voter voted for; a voter may vote for several candidates, and their one vote is split equally among them. Report the candidate or candidates with the most votes, ordered as the statement says. How voters with no candidate are recorded and the output names are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nTally with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Weighted sums', 'next' => 's2'],
                ['label' => 'Row counts', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Split votes count fully; in SQLite the check → A and B tied at 2 instead of A.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Weight each row by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 / COUNT(*) per voter', 'next' => 'wrong_b'],
                ['label' => '1.0 / COUNT(*) per voter', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Integer division gives 0; in SQLite with v1–v3 each voting A and B and v4 voting C → C instead of A and B.\nStep back to when you used 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The check → A with 1.5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
