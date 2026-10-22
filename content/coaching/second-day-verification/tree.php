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
            'message' => "Problem: One table records each sign-up: an email, the user it belongs to and the sign-up time. Another records text messages sent to those emails: the action the user took and when. Return the users who verified on the second day, as the statement defines it. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCompare how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Text date = sign-up date + 1 day', 'next' => 's2'],
                ['label' => 'Within 24 hours of sign-up', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check that also returns user 2.\nStep back to when you used a 24-hour window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which texts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any text', 'next' => 'wrong_b'],
                ['label' => 'Only the confirming action', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the guide’s check user 3’s non-confirming text gets them in.\nStep back to when you kept every text.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → user 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
