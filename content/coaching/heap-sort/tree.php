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
            'message' => "State:\na = [3, 1, 4, 2]\nafter build max-heap\n\nRoot holds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4 — maximum of the array', 'next' => 'extract'],
                ['label' => '1 — minimum of the array', 'next' => 'w_min'],
            ],
        ],
        'w_min' => [
            'message' => "Wrong.\n\nA max-heap root is the maximum.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'extract' => [
            'message' => "State:\nswap root with last, shrink heap, sift down\n\nWhat are you building?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A growing sorted suffix of maxima on the right', 'next' => 'build'],
                ['label' => 'A sorted prefix of minima on the left only', 'next' => 'w_pref'],
            ],
        ],
        'w_pref' => [
            'message' => "Wrong.\n\nClassic heap sort parks extracted maxima at the end.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'extract',
            'choices' => [],
        ],
        'build' => [
            'message' => "State:\nbuild-heap on n items\n\nCost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) — not O(n log n)', 'next' => 'success'],
                ['label' => 'O(n log n) — each insert from empty is required', 'next' => 'w_build'],
            ],
        ],
        'w_build' => [
            'message' => "Wrong.\n\nBottom-up heapify is O(n). Repeated push-from-empty would be O(n log n).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'build',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Heapify O(n), then n× sift → O(n log n)\n- In-place, not stable\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
