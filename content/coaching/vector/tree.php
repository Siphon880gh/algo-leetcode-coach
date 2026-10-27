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
            'message' => "State:\nvector = [10, 20]\ncapacity = 2\naction: append 30\n\nThe capacity is full. What must happen first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allocate capacity 4, copy 10 and 20, then write 30', 'next' => 'after_grow'],
                ['label' => 'Write 30 at index 2 without allocating anything', 'next' => 'wrong_noalloc'],
            ],
        ],
        'wrong_noalloc' => [
            'message' => "Wrong.\n\nWith capacity 2 there is no free slot. Growing means allocating a larger buffer, copying, and then writing.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_grow' => [
            'message' => "After growing:\nvector = [10, 20, 30, _]\ncapacity = 4\n\nThat one append was expensive, but later appends into free slots are cheap.\n\nNow a different action: insert a value X at index k = 1 in a vector of length 4. What does it cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n), because the elements from index 1 to the end shift right', 'next' => 'why_shift'],
                ['label' => 'O(1), the same as a cheap append after doubling', 'next' => 'wrong_free'],
            ],
        ],
        'wrong_free' => [
            'message' => "Wrong.\n\nDoubling made *appending* cheap on average. Inserting in the middle still needs a gap in contiguous memory, so everything after it shifts.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'after_grow',
            'choices' => [],
        ],
        'why_shift' => [
            'message' => "Suppose a rebuild does n inserts in the middle this way, for example placing people by height at index k.\n\nWhat is the total time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²), because each insert can shift up to O(n) elements', 'next' => 'success'],
                ['label' => 'Still O(n) in total, because growth was amortized', 'next' => 'wrong_lin'],
            ],
        ],
        'wrong_lin' => [
            'message' => "Wrong.\n\nAmortized O(1) applies to appends with doubling, not to n separate inserts in the middle. n inserts of O(n) each add up to O(n²).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'why_shift',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Growing on append means allocate, copy, then write, which keeps n appends at O(n) in total.\n- Inserting at index k shifts everything after it, so n such inserts cost O(n²) in a plain vector.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
