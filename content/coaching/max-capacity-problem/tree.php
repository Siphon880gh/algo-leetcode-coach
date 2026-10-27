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
            'message' => "State:\nheights = [1, 8, 6, 2, 5, 4, 8, 3, 7]\nL = 0 (height 1)\nR = 8 (height 7)\n\nWhat is the area now?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '8, from min(1, 7) × 8', 'next' => 'mid'],
                ['label' => '56, from 7 × 8, ignoring the short side', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe water is limited by the shorter line, so the area is min(1, 7) × 8 = 8.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe short side is L, with height 1\n\nWhich pointer moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L, the shorter end', 'next' => 'ask'],
                ['label' => 'R, the taller end', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nMoving the tall side only shrinks the width while the smaller height stays at most 1. Move L.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'ask' => [
            'message' => "State:\nL moves to index 1 (height 8)\nR is still at index 8 (height 7)\n\nWhat is the new area?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '49, from min(8, 7) × 7', 'next' => 'success'],
                ['label' => '8, the same as before', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThe width is 7 and the smaller height is 7, so the area is 49.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- The area is the smaller height times the width.\n- Always move the shorter pointer.\n- The best area here is 49.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
