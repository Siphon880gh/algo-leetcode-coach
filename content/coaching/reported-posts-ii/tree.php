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
            'message' => "Problem: An actions table logs posts reported for various reasons, and a removals table lists posts that were removed. Among posts reported as spam, compute the percentage removed for each day, then report the average of those daily percentages, rounded as the statement specifies. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCount report rows per day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count distinct posts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One post can be reported many times.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join to removals with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An inner join', 'next' => 'wrong_b'],
                ['label' => 'A left join', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Posts that were not removed must stay in the denominator.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The average of daily percentages', 'next' => 'success'],
                ['label' => 'Total removed over total reported', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each day weighs equally.\nStep back to when you pooled the days.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One average over the daily percentages, rounded as specified.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
