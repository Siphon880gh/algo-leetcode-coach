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
            'message' => "Read the problem statement above.\nGreedy: apply the biggest discount first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: search over the remaining needs, with memo', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A big discount can use up items that a combination of smaller offers would price better.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which offers can you apply?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any offer, even if it buys extra items', 'next' => 'wrong_b'],
                ['label' => 'Only those that never exceed any remaining need', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The problem forbids buying more than you need, even when it would be cheaper.\nStep back to when you allowed extras.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What else must every state consider?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Buying everything left at list price', 'next' => 'success'],
                ['label' => 'Nothing else', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sometimes no offer is worth it.\nStep back to when you dropped the list-price option.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Memo on tuple(needs), offers that fit, and list price: small state space for 6 items of up to 10. price [2,5], offers [[3,0,5],[1,2,10]], needs [3,2] → 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
