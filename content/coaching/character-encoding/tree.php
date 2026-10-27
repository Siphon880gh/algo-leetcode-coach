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
            'message' => "State:\na UTF-8 string containing one emoji, U+1F44D\n\nHow many bytes does that emoji take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4', 'next' => 'mid'],
                ['label' => '1, because every character is one byte in UTF-8', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nCode points above U+FFFF need 4 bytes in UTF-8.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ncomparing the byte length with the number of characters\n\nAre they always equal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. Characters that take several bytes make them differ.', 'next' => 'final'],
                ['label' => 'Yes, for all Unicode text', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nThey only match for plain ASCII text.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou cut a UTF-8 string at a random byte in the middle\n\nWhat can go wrong?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'You split a character and corrupt the string', 'next' => 'success'],
                ['label' => 'Nothing, because UTF-8 repairs any cut', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nA cut must fall on a character boundary.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Unicode assigns code points, and UTF-8 turns them into bytes.\n- Do not mix up byte length and character count.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
