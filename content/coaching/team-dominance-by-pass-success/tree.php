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
            'message' => "Problem: Two tables list players with their team and timestamped passes from one player to another. For each team and each half of the match, score +1 for every pass to a teammate and −1 for every pass the other team receives. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCredit the pass to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The passer’s team', 'next' => 's2'],
                ['label' => 'The receiver’s team', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The guide’s data → Lions 2 and 2 instead of 1 and 3.\nStep back to when you grouped by the receiver.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First half test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ts < \'45:00\'', 'next' => 'wrong_b'],
                ['label' => 'ts <= \'45:00\'', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The Lions pass at 45:00 moves: Lions 0 and 4.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → Lions 1, 3; Tigers 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
