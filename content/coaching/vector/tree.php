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
            'message' => "State:\nvector = [10, 20]\ncapacity = 2\naction = append 30\n\nCapacity is full. What must happen first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allocate capacity 4, copy 10 and 20, then write 30', 'next' => 'after_grow'],
                ['label' => 'Write 30 at index 2 with no new allocation', 'next' => 'wrong_noalloc'],
            ],
        ],
        'wrong_noalloc' => [
            'message' => "Wrong.\n\nWith capacity 2 there is no free slot. Growth allocates a larger buffer first, then copies, then writes.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_grow' => [
            'message' => "After growth:\nvector = [10, 20, 30, _]\ncapacity = 4\n\nAppending felt expensive once, but later appends into free slots are cheap. Now a different action: insert value X at index k = 1 in a length-4 vector. Cost class?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) — elements from index 1 to the end shift right', 'next' => 'why_shift'],
                ['label' => 'O(1) — same as a cheap append after doubling', 'next' => 'wrong_free'],
            ],
        ],
        'wrong_free' => [
            'message' => "Wrong.\n\nDoubling made *append* amortized cheap. Mid-insert still needs a contiguous hole, so the tail shifts.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'after_grow',
            'choices' => [],
        ],
        'why_shift' => [
            'message' => "If a rebuild does n mid-inserts this way (for example placing people by height at index k), total time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²) — each insert can shift up to O(n) elements', 'next' => 'success'],
                ['label' => 'Still O(n) total because growth was amortized', 'next' => 'wrong_lin'],
            ],
        ],
        'wrong_lin' => [
            'message' => "Wrong.\n\nAmortized O(1) applies to appends with doubling, not to n independent mid-inserts. n × O(n) shifts → O(n²).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'why_shift',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Growth-on-append: allocate, copy, write — keeps n appends O(n) total.\n- Mid-insert at k: shifts the tail — different cost; n of them are O(n²) in a naive vector.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
