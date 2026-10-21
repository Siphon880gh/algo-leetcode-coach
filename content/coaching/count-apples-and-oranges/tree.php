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
            'message' => "Problem: A boxes table lists apple and orange counts per box and optionally a chest id; a chests table lists apple and orange counts per chest. Report the total apples and oranges across all boxes, including the contents of any chest inside a box, with the column names the statement specifies. For instance, a box with 2 apples, 3 oranges and a chest holding 1 and 1, plus a box with 4 apples and no chest, give 7 apples and 4 oranges. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich join?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN boxes to chests', 'next' => 's2'],
                ['label' => 'INNER JOIN', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An inner join drops boxes with no chest.\nStep back to when you chose the inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Missing chest values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave them NULL', 'next' => 'wrong_b'],
                ['label' => 'IFNULL(chest count, 0)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A NULL term makes that whole box sum NULL.\nStep back to when you left NULLs in.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Also sum the chests table alone?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, only chests inside boxes', 'next' => 'success'],
                ['label' => 'Yes, add every chest', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only chests placed in boxes count.\nStep back to when you added every chest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass over the join. Constructed check → 7 apples, 4 oranges.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
