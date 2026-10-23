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
capacity = 4
table = [ _, _, _, _ ]
A hashes to bucket 2
strategy = chaining

After insert A?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[ _, _, A, _ ] — A sits in bucket 2', 'next' => 'after_a'],
                ['label' => 'A rejected — empty table cannot store keys', 'next' => 'w_empty'],
            ],
        ],
        'w_empty' => [
            'message' => 'Wrong.

Empty slots are ready for the first key. Place A in bucket 2.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_a' => [
            'message' => 'State:
table bucket 2 holds A
E also hashes to 2
chaining

Where does E go?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On bucket 2’s list: A → E', 'next' => 'ask_probe'],
                ['label' => 'Rejected forever — bucket taken', 'next' => 'w_rej'],
            ],
        ],
        'w_rej' => [
            'message' => 'Wrong.

Chaining keeps both keys on that bucket’s list.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'after_a',
            'choices' => [],
        ],
        'ask_probe' => [
            'message' => 'State:
open addressing instead
slots [ _, _, A, E ]
delete A by writing empty in slot 2
lookup E

Bug?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Probe may stop at the hole and miss E', 'next' => 'success'],
                ['label' => 'No bug — empty always means stop safely', 'next' => 'w_hole'],
            ],
        ],
        'w_hole' => [
            'message' => 'Wrong.

A hole mid-probe looks like “not found”. Use a tombstone so the probe continues to E.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_probe',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Collision → chain or probe
- Open-address delete needs tombstones

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
