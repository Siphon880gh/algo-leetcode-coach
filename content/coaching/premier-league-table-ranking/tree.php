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
            'message' => "Problem: A table lists teams with their wins, draws and losses. Compute each team’s points and rank the teams by points, in the format the statement asks. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nPoints?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3 · wins + draws', 'next' => 's2'],
                ['label' => 'wins + draws', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Under the guide’s assumption Elm then ranks alone at 1.\nStep back to when you counted wins once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rank with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER()', 'next' => 'wrong_b'],
                ['label' => 'RANK()', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ash and Elm tie on 10 but get 1 and 2.\nStep back to when you used ROW_NUMBER.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. The guide’s check → Ash 10 (1), Elm 10 (1), Yew 9 (3), Oak 3 (4).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
