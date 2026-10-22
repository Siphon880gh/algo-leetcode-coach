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
            'message' => "Problem: A table logs when servers start and stop. Add up the time all servers were running and report the total in the unit and rounding the statement gives. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nPair a start with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The next event only', 'next' => 's2'],
                ['label' => 'Every later stop', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check, that gives 6 days instead of 3.\nStep back to when you joined every stop.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "LEAD over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All rows together', 'next' => 'wrong_b'],
                ['label' => 'Each server separately', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Starts pair with other servers’ events: 48 hours, 2 days, instead of 3.\nStep back to when you dropped the partition.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sum the seconds, then convert as the statement asks.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
