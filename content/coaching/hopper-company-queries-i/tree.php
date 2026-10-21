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
            'message' => "Problem: Given drivers (with join dates), rides and accepted-ride tables, report for every month of 2020 the number of drivers active by the end of that month and the number of rides accepted that month, with the columns and ordering the statement specifies. For instance, one driver who joined in December 2019 and another in March 2020 give 1 active driver in January and 2 in March. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nStart from which table?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A 12-month calendar', 'next' => 's2'],
                ['label' => 'The rides table', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Months with no rides would vanish.\nStep back to when you started from rides.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Active drivers in month m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Joined during month m', 'next' => 'wrong_b'],
                ['label' => 'Joined on or before the end of month m', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Drivers stay active after joining.\nStep back to when you counted joins only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Months with no accepted rides?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COALESCE to 0', 'next' => 'success'],
                ['label' => 'Leave NULL', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The report needs a number every month.\nStep back to when you left NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check: Jan 1, Feb 1, Mar 2 active drivers.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
