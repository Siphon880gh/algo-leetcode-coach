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
            'message' => "Problem: Tables list purchases (a user, a date, an amount) and users with a membership type. For the Fridays of the period the statement gives, report the total spent by each membership type the statement names. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nStart from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A calendar of Fridays × types', 'next' => 's2'],
                ['label' => 'The purchases', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Empty combinations vanish: the guide’s check returns 4 rows instead of 8.\nStep back to when you grouped the purchases.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which Fridays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any Friday', 'next' => 'wrong_b'],
                ['label' => 'Only those inside the period', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the guide’s check, the December purchase shows up.\nStep back to when you dropped the period.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. COALESCE(SUM(amount), 0), labelled and ordered as asked.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
