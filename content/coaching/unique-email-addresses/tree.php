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
            'message' => "Read the problem statement above.\nWhere do the rules apply?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only to the local name, before "@"', 'next' => 's2'],
                ['label' => 'To the whole address', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Dots in the domain matter.\nStep back to when you changed the domain.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The local name has a \"+\". Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove only the "+"', 'next' => 'wrong_b'],
                ['label' => 'Drop it and everything after it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Everything after the first \"+\" is ignored.\nStep back to when you kept the tail.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add each normalized address to a set', 'next' => 'success'],
                ['label' => 'Count the input addresses', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Different inputs can normalize to the same address.\nStep back to when you counted inputs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). [\"test.email+alex@leetcode.com\",\"test.e.mail+bob.cathy@leetcode.com\",\"testemail+david@lee.tcode.com\"] → 2. [\"a@leetcode.com\",\"b@leetcode.com\",\"c@leetcode.com\"] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
