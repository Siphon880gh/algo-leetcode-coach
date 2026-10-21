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
            'message' => "Read the problem statement above.\nToken expiring exactly now?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Already expired (use >)', 'next' => 's2'],
                ['label' => 'Still valid (use ≥)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Expiry happens before other actions at the same time.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Renew an unknown or expired token?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Create it', 'next' => 'wrong_b'],
                ['label' => 'Ignore it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only generate creates tokens.\nStep back to when you created it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Store what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The expiry time', 'next' => 'success'],
                ['label' => 'The generation time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Renew resets expiry; storing expiry keeps checks simple.\nStep back to when you stored the start.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) generate/renew, O(n) count. Example → 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
