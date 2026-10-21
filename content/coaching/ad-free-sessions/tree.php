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
            'message' => "Problem: A playback table lists sessions with a customer and a start and end time; an ads table lists ads shown to a customer at a timestamp. Report the sessions during which the customer was shown no ad, with the column name the statement specifies. For instance, a session 15–23 for a customer whose only ad was at 5 is ad-free, while a session 17–28 with an ad at 20 for the same customer is not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nTime condition placed in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The ON clause', 'next' => 's2'],
                ['label' => 'The WHERE clause', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In WHERE it turns the left join into an inner join.\nStep back to when you put it in WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Match on customer too?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, any ad counts', 'next' => 'wrong_b'],
                ['label' => 'Yes, same customer', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only ads shown to that customer matter.\nStep back to when you ignored the customer.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Keep which rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Where the ad side is NULL', 'next' => 'success'],
                ['label' => 'Where it is not NULL', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Matched rows had ads.\nStep back to when you kept matches.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Anti-join. Constructed check → sessions 2 and 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
