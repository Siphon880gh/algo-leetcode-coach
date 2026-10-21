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
            'message' => "Read the problem statement above.\nWhen do you close a run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the next letter differs or the string ends', 'next' => 's2'],
                ['label' => 'At every index', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A run spans every equal letter in a row.\nStep back to when you closed at every index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How long must a large group be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 or more', 'next' => 'wrong_b'],
                ['label' => '3 or more', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The problem says at least 3.\nStep back to when you accepted 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Could the last run be missed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, unless you also check at the end', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With no letter change after it, only an end check closes it.\nStep back to when you skipped the end check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abbxxxxzzy\" → [[3,6]]. \"abcdddeeeeaabbbcd\" → [[3,5],[6,9],[12,14]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
