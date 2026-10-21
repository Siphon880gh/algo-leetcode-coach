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
            'message' => "Read the problem statement above.\nLoop condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'len(s) > k', 'next' => 's2'],
                ['label' => 'len(s) ≥ k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 keeps going past 135 and → 9 instead of 135.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Last block shorter than k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop it', 'next' => 'wrong_b'],
                ['label' => 'Sum it like the others', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 loses 23 in round one and → 346 instead of 135.\nStep back to when you dropped the short block.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Write each block sum as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its full decimal string', 'next' => 'success'],
                ['label' => 'Its last digit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 3 + 4 + 6 = 13 must stay 13; Example 1 → 35 instead of 135.\nStep back to when you kept one digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 135, 000.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
