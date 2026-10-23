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
            'message' => "State:\nUTF-8 string with one emoji (U+1F44D)\n\nBytes for that emoji?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4', 'next' => 'mid'],
                ['label' => '1 — every char is one byte in UTF-8', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nSupplementary code points need 4 bytes in UTF-8.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nbyte length vs character count\n\nEqual always?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No — multi-byte code points break equality', 'next' => 'final'],
                ['label' => 'Yes for all Unicode text', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nASCII-only is the special case.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nsplice UTF-8 at a random mid-byte\n\nRisk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Split a character — corrupt string', 'next' => 'success'],
                ['label' => 'UTF-8 self-heals any cut', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nCuts must respect boundaries.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Unicode code points; UTF-8 bytes\n- Do not confuse lengths\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
