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
            'message' => "Problem: One table records gifts: a giver, a receiver and a gift value. Find every loop of exchanges (A gives to B, B to C, …, back to A) and report each loop’s length and total gift value, numbered and ordered by length and then total, both descending. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nStop walking when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Back at the start, or after row-count steps', 'next' => 's2'],
                ['label' => 'Only when no next gift exists', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Around a loop there is always a next gift, so the walk never ends.\nStep back to when you dropped the stop.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which loop rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every loop row', 'next' => 'wrong_b'],
                ['label' => 'Start = smallest member', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The guide’s check → 7 rows instead of 3.\nStep back to when you kept every row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) worst case. The guide’s check → (1, 3, 60), (2, 2, 65), (3, 2, 60).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
