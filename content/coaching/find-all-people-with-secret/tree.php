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
            'message' => "Read the problem statement above.\nProcess meetings in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By time', 'next' => 's2'],
                ['label' => 'In input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 2: person 1 learns at time 3, after meeting 2 at time 2, so 2 never learns; input order would tell 2.\nStep back to when you used input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Meetings 2–3 and 1–2 at the same time, 1 knows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only 2 learns it if 2–3 is listed first', 'next' => 'wrong_b'],
                ['label' => 'Both 2 and 3 learn it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sharing within one time is instantaneous, so it travels through chains; Example 3 → everyone.\nStep back to when you handled meetings one by one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "People in a time group who did not learn it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Disconnect them before the next time', 'next' => 'success'],
                ['label' => 'Keep them connected', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A later meeting would then spread the secret back through an old connection.\nStep back to when you kept the union.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(M log M + n). Examples → [0,1,2,3,5], [0,1,3], [0,1,2,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
