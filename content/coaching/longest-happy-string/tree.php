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
            'message' => "Read the problem statement above.\nDefault pick?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Most remaining copies', 'next' => 's2'],
                ['label' => 'Fixed rotation a, b, c', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The most frequent letter must lead or it gets stranded.\nStep back to when you rotated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Last two equal the top letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use it anyway', 'next' => 'wrong_b'],
                ['label' => 'Use the next letter', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Three in a row is not allowed.\nStep back to when you used it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No other letter left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop', 'next' => 'success'],
                ['label' => 'Append anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The string would become unhappy.\nStep back to when you appended.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(a + b + c). (1, 1, 7) → \"ccaccbcc\". (7, 1, 0) → \"aabaa\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
