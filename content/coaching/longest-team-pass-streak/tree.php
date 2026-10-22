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
            'message' => "Problem: Using the same two tables as Team Dominance by Pass Success, find for each team its longest run of consecutive passes, in time order, that reach a teammate. A pass received by the other team ends the run. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRunning count over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each team’s own passes', 'next' => 's2'],
                ['label' => 'All passes together', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The guide’s data → Lions 3 instead of 4.\nStep back to when you dropped PARTITION BY.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All successful passes', 'next' => 'wrong_b'],
                ['label' => 'Longest run per team', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The guide’s data → Lions 5, Tigers 4.\nStep back to when you counted all.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → Lions 4, Tigers 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
