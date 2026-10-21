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
            'message' => "Read the problem statement above.\nGreedy apply the better op?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: explore all reachable strings', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A worse step can enable a better rotation later.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "State count bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Infinite', 'next' => 'wrong_b'],
                ['label' => 'About n rotations × 10 × 10 digit offsets', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Digits cycle mod 10 and rotations cycle mod n.\nStep back to when you feared infinity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Add operation affects?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Odd indices only', 'next' => 'success'],
                ['label' => 'All indices', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only odd (0-indexed) positions change.\nStep back to when you changed all.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → \"2050\", \"24\", \"0011\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
