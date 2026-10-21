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
            'message' => "Problem: Using tables of users (with a favourite brand), orders (with a date, item, buyer, and seller), and items (with a brand), report for every user whether the brand of the second item they sold, by date, is their favourite brand; users who sold fewer than two items get a no. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nHow do you find the second sale?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER over seller ordered by date, rank 2', 'next' => 's2'],
                ['label' => 'The second smallest order id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The order is by date.\nStep back to when you used order ids.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Put rank = 2 where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In WHERE', 'next' => 'wrong_b'],
                ['label' => 'In the LEFT JOIN condition', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Users with fewer than two sales must stay.\nStep back to when you filtered in WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No second sale. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'no', 'next' => 'success'],
                ['label' => 'NULL', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The CASE falls to its else branch.\nStep back to when you returned NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). One yes or no per user.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
