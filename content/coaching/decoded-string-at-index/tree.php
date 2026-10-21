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
            'message' => "Read the problem statement above.\nBuild the decoded string?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it can be 2⁶³ characters long', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It does not fit in memory.\nStep back to when you built it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Walking backward, first do what at each position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k −= 1', 'next' => 'wrong_b'],
                ['label' => 'k %= size', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. After a digit, the tape is several copies, so position k equals k mod size.\nStep back to when you decremented.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k == 0 and the character is a letter. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return it: it is the last character of the current tape', 'next' => 'success'],
                ['label' => 'Keep walking', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. k == 0 stands for the last position, which is this letter.\nStep back to when you kept walking.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. \"leet2code3\", k = 10 → \"o\". \"ha22\", k = 5 → \"h\". \"a2345678999999999999999\", k = 1 → \"a\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
