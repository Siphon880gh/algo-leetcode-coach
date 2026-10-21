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
            'message' => "Read the problem statement above.\nApply the replacements one by one to the string?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: check all matches on the original, then build once', 'next' => 's2'],
                ['label' => 'Yes, in the given order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Earlier replacements shift the later indices.\nStep back to when you edited in place.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The indices are not sorted. What do you do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Process them in the given order', 'next' => 'wrong_b'],
                ['label' => 'Map each index to its replacement (or sort by index)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Building left to right needs the replacements in index order.\nStep back to when you kept the input order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A source does not occur at its index. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it and copy the original characters', 'next' => 'success'],
                ['label' => 'Replace anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A replacement only applies when the source matches at that index.\nStep back to when you replaced blindly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + total length). s = \"abcd\", indices [0,2], sources [\"a\",\"cd\"], targets [\"eee\",\"ffff\"] → \"eeebffff\". With sources [\"ab\",\"ec\"] → \"eeecd\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
