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
            'message' => "State:\ntwo children, at least one is a boy\nboys and girls are equally likely\n\nWhat is the chance that both are boys?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1/3', 'next' => 'mid'],
                ['label' => '1/2', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nAfter the clue, three equally likely outcomes remain (BB, BG, GB), and only one of them is BB.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou face a new probability puzzle like this\n\nWhat is the first step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'List the equally likely outcomes', 'next' => 'final'],
                ['label' => 'Trust your intuition right away', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nWriting out the outcomes beats a gut feeling.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nthe condition is \"at least one boy\"\n\nWhich outcome does it rule out?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'GG', 'next' => 'success'],
                ['label' => 'BB', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nGG is the only outcome with no boy.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- List the outcomes, apply the condition, then count.\n- Here the answer is 1/3.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
