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
            'message' => "Problem: A subscriptions table gives each account's subscription start and end dates, and a streams table records streaming sessions with an account and a date. Report how many accounts had a subscription during the year the statement names but had no streaming session in that year. For instance, an account subscribed through that year whose only stream was the year before counts; an account that streamed during the year does not; an account whose subscription ended before the year does not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nSubscribed during the year when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'start ≤ end of the year and end ≥ start of the year', 'next' => 's2'],
                ['label' => 'The start date falls in the year', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A subscription that began the year before and runs into it is active too.\nStep back to when you checked the start only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which streams exclude an account?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any stream ever', 'next' => 'wrong_b'],
                ['label' => 'Only streams dated in that year', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A stream from an earlier year says nothing about this one.\nStep back to when you used every stream.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Inner join streams and keep rows dated outside the year?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, use an anti-join', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An account that streamed both in and outside the year would still appear.\nStep back to when you joined.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
