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
            'message' => "Problem: A login log records, per session, an account, an IP address, a login time and a logout time. Report every account that was logged in from two different IP addresses at overlapping times, with the column name the statement specifies. For instance, an account with sessions 10:00–11:00 on one IP and 10:30–12:00 on another is reported; one with 9:00–10:00 and 11:00–12:00 on different IPs is not, and overlapping sessions on the same IP do not count. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same account, different IP', 'next' => 's2'],
                ['label' => 'Same IP', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only different addresses at the same time are suspicious.\nStep back to when you matched on IP.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Overlap test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same login time only', 'next' => 'wrong_b'],
                ['label' => 'One login lies within the other session', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sessions can overlap without starting together.\nStep back to when you required equal logins.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Duplicates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SELECT DISTINCT the account', 'next' => 'success'],
                ['label' => 'Return every pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One account can match many pairs.\nStep back to when you returned pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Self-join. Constructed check → only the overlapping account.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
