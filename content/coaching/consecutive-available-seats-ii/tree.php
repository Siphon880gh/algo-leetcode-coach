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
            'message' => "Problem: A table lists cinema seats and whether each one is free. Report the longest run (or runs) of consecutive free seats: where each run starts, where it ends and how long it is. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGroup free seats by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'seat id − ROW_NUMBER', 'next' => 's2'],
                ['label' => 'Nothing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check, you get one row, 1–12 with 9 seats.\nStep back to when you skipped the key.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep which runs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first after sorting by length', 'next' => 'wrong_b'],
                ['label' => 'All with the maximum length', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. LIMIT 1 drops the tied run 7–9 in the guide’s check.\nStep back to when you kept one row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. MIN, MAX and COUNT per run, ordered as asked.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
