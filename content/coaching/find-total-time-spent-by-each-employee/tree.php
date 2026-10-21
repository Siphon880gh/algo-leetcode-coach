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
            'message' => "Read the problem statement above.\nGroup by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'event_day and emp_id', 'next' => 's2'],
                ['label' => 'emp_id only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Totals are per employee per day.\nStep back to when you grouped by employee only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Per-visit time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MAX(out_time) − MIN(in_time)', 'next' => 'wrong_b'],
                ['label' => 'out_time − in_time', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That would count the gaps between visits.\nStep back to when you took the span.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output column for the date?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'event_day AS day', 'next' => 'success'],
                ['label' => 'event_day as is', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The result names the column day.\nStep back to when you kept event_day.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rows). Example → 173, 30, 41, 27.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
