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
            'message' => "Problem: A sessions table records durations. Report the number of sessions in each fixed duration bin (labels and boundaries as the statement specifies), including empty bins. For instance, with no sessions in the longest bin, that bin still shows 0. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGROUP BY a CASE label?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: empty bins vanish', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Grouping never produces a 0 row.\nStep back to when you grouped the label.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edge values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Closed on both ends', 'next' => 'wrong_b'],
                ['label' => 'Half-open ranges', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A boundary value would land in two bins.\nStep back to when you closed both ends.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Units?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Convert to the bins\' unit', 'next' => 'success'],
                ['label' => 'Compare raw values', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Durations and bin edges may use different units.\nStep back to when you compared raw values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One row per bin, with zeros included.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
