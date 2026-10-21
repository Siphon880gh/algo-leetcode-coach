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
            'message' => "Read the problem statement above.\nYou are at a '<'. What do you check first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'CDATA (<![CDATA[) before any tag', 'next' => 's2'],
                ['label' => 'An opening tag first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. <![ also starts with <, so you would read the CDATA as a bad tag name.\nStep back to when you checked tags first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When are plain text and CDATA allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Anywhere', 'next' => 'wrong_b'],
                ['label' => 'Only while the stack of open tags is not empty', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The whole code must be wrapped in one closed tag, so nothing may sit outside it.\nStep back to when you allowed text anywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A closing tag empties the stack. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Valid only if that is the end of the code', 'next' => 'success'],
                ['label' => 'Keep scanning for more tags', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. <A></A><B></B> is invalid: the code must be a single closed tag.\nStep back to when you kept scanning.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One scan with a tag stack, CDATA checked first, and an empty stack only at the end: O(n) time.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
