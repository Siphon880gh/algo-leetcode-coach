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
            'message' => "State:\na = [1, 2, 2, 2, 5]\nneed first index with a[i] >= 2\n\nAnswer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'mid'],
                ['label' => '3 — that is the last 2', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nFirst ≥2 is the leftmost 2 at index 1.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nboolean strip F F T T T\nlooking for first T\n\nIf ok(mid) is True, move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'hi = mid — answer is mid or left of mid', 'next' => 'final'],
                ['label' => 'lo = mid — discard the left including mid', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nA True mid might be the first True; keep it with hi=mid.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nneed last index with a[i] == 2 in that array\n\nIndex?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3', 'next' => 'success'],
                ['label' => '1 — first is the same as last here', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nLast 2 sits at index 3.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Boundary search ≠ “any hit”\n- Bias lo/hi for first vs last\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
