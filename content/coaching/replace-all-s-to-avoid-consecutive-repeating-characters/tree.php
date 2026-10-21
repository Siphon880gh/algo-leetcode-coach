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
            'message' => "Read the problem statement above.\nHow many candidate letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Three: a, b, c', 'next' => 's2'],
                ['label' => 'All 26 every time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only two neighbours can block, so three letters always leave one free.\nStep back to when you tried all 26.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Left neighbour a ??",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'Already replaced; compare with it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Scanning left to right, it is fixed now.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Change original letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'success'],
                ['label' => 'Yes, if needed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only ? may change; the input has no adjacent repeats among letters.\nStep back to when you changed one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"?zs\" → \"azs\". \"ubv?w\" → \"ubvaw\". Any valid answer is accepted.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
