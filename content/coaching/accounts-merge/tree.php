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
            'message' => "Read the problem statement above.\nMerge accounts with the same name?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: different people can share a name; link through emails', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Names are not unique.\nStep back to when you merged by name.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Accounts A and C share no email, but each shares one with B. Merge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'wrong_b'],
                ['label' => 'Yes: union-find links them transitively', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Shared emails chain accounts into one person.\nStep back to when you required a direct share.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How is each merged account written?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The name, then the emails sorted', 'next' => 'success'],
                ['label' => 'The emails in input order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for sorted emails.\nStep back to when you kept input order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Union-find over emails: O(E log E). Two John accounts sharing johnsmith@mail.com merge; the other John and Mary stay separate.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
