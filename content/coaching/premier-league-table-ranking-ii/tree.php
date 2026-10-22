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
            'message' => "Problem: A table lists teams with their wins, draws and losses. Compute each team’s points and position, and place each team in one of three tiers by position, in the format the statement asks. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nPosition with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'RANK()', 'next' => 's2'],
                ['label' => 'ROW_NUMBER()', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check Elm gets 2 although it ties Ash.\nStep back to when you used ROW_NUMBER.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order the output by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Position only', 'next' => 'wrong_b'],
                ['label' => 'Points, then name', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ash and Elm share position 1, so their order is left undefined.\nStep back to when you ordered by position only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → positions 1, 1, 3, 4, 5, 6 and tiers 1, 1, 2, 2, 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
