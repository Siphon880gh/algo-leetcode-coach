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
            'message' => 'State:
heights = [1, 8, 6, 2, 5, 4, 8, 3, 7]
L = 0 (h=1)
R = 8 (h=7)

Area now?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '8 — min(1,7)*8', 'next' => 'mid'],
                ['label' => '56 — 7*8 ignoring the short side', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => 'Wrong.

Water is limited by the shorter line → min(1,7)*8=8.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => 'State:
short side is L (1)

Which pointer moves?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L — advance the shorter end', 'next' => 'ask'],
                ['label' => 'R — advance the taller end', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => 'Wrong.

Moving the tall side only shrinks width while min stays ≤1. Move L.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'ask' => [
            'message' => 'State:
L moves to index 1 (h=8)
R still 8 (h=7)

New area?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '49 — min(8,7)*7', 'next' => 'success'],
                ['label' => '8 — same as before', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => 'Wrong.

Width 7, height min 7 → 49.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Area = min heights × width
- Always move the shorter pointer
- Best here reaches 49

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
