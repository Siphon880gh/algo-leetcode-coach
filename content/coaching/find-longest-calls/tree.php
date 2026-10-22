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
            'message' => "Problem: Tables list calls (a contact, a call type, a duration) and contacts with names. For each call type, report the longest calls (as many as the statement asks) with the contact’s name and the duration in the format the statement gives. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRanking?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER per type', 'next' => 's2'],
                ['label' => 'One overall ranking', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check, the shorter outgoing calls drop out.\nStep back to when you ranked overall.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Minutes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'duration / 60', 'next' => 'wrong_b'],
                ['label' => 'duration % 3600 / 60', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 3,725 seconds shows 62 minutes instead of 2.\nStep back to when you skipped the % 3600.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Join the names; format each part with two digits.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
