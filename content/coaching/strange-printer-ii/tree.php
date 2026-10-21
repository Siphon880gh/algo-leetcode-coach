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
            'message' => "Read the problem statement above.\nWhat region does a colour print?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its bounding rectangle', 'next' => 's2'],
                ['label' => 'Only its own cells', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each print is a full rectangle.\nStep back to when you used only its cells.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Other colour d inside c's box?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'Edge c → d: d printed later', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. d must cover c there.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Printable when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The graph has no cycle', 'next' => 'success'],
                ['label' => 'Every colour has a box', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two colours that must each cover the other can never both end on top.\nStep back to when you skipped the cycle check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(C · m · n). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
