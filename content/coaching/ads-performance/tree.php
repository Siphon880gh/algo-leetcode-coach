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
            'message' => "Problem: An ads table logs, per ad and user, whether the user clicked, viewed, or ignored the ad. Report each ad's click-through rate (clicks over clicks plus views, as a percentage, or 0 with neither), with rounding and ordering as the statement specifies. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nDenominator?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clicks plus views', 'next' => 's2'],
                ['label' => 'All actions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Ignores do not count.\nStep back to when you counted every row.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Filter ignored rows in WHERE?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ads with only ignores must still appear with 0.\nStep back to when you filtered them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No clicks and no views?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rate 0', 'next' => 'success'],
                ['label' => 'NULL', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for 0.\nStep back to when you left NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. For instance, 2 clicks, 1 view, 1 ignore → about 66.67.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
