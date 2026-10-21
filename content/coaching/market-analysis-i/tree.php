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
            'message' => "Read the problem statement above.\nFilter the year where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In the ON clause', 'next' => 's2'],
                ['label' => 'In WHERE', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Users with no 2019 orders would disappear.\nStep back to when you used WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join users as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sellers', 'next' => 'wrong_b'],
                ['label' => 'Buyers: o.buyer_id = u.user_id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The count is of orders made as a buyer.\nStep back to when you joined sellers.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "COUNT what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(o.order_id)', 'next' => 'success'],
                ['label' => 'COUNT(*)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A user with no match would count 1.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(users + orders). Every user, with 0 when they bought nothing in 2019.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
