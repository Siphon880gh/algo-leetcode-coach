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
            'message' => "Read the problem statement above.\nCut as early or late as possible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As early: at each zero', 'next' => 's2'],
                ['label' => 'As late as possible', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Late cuts merge pieces and lower the count.\nStep back to when you waited.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Track what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total R and L counts', 'next' => 'wrong_b'],
                ['label' => 'A running balance', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Totals ignore where pieces end.\nStep back to when you used totals.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "\"LLLLRRRR\" → ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'success'],
                ['label' => '4', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The balance only returns to 0 at the end.\nStep back to when you counted pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"RLRRLLRLRL\" → 4. \"RLRRRLLRLL\" → 2. \"LLLLRRRR\" → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
