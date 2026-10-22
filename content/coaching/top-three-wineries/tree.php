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
            'message' => "Problem: A table lists wineries’ entries, each with a country and points. For each country, report the top three wineries by total points, each shown with its points in the format the statement gives, breaking ties as it says and using its placeholder text when a country has fewer than three wineries. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRank by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total points per winery', 'next' => 's2'],
                ['label' => 'Single rows', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the sample Ama’s 85 + 50 = 135 beats Bel’s 90, but single rows put Bel first.\nStep back to when you ranked rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A country with fewer than three?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave the column NULL', 'next' => 'wrong_b'],
                ['label' => 'COALESCE to the placeholder', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The sample’s Q would show NULL where the statement wants its placeholder text.\nStep back to when you left NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sample → P: Ama (135), Bel (90), Cor (70).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
