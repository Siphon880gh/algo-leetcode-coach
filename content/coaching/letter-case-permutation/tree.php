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
            'message' => "Read the problem statement above.\nBranch on every character?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only letters have two forms', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Branching on digits creates duplicates.\nStep back to when you branched on digits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many results for L letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L!', 'next' => 'wrong_b'],
                ['label' => '2^L', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each letter makes an independent two-way choice.\nStep back to when you used L!.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you swap the case of an ASCII letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR its code with 32', 'next' => 'success'],
                ['label' => 'Add 32', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Adding 32 only works for uppercase; XOR toggles both ways.\nStep back to when you added 32.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^L · n). \"a1b2\" → [\"a1b2\",\"a1B2\",\"A1b2\",\"A1B2\"]. \"3z4\" → [\"3z4\",\"3Z4\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
