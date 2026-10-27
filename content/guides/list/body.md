## Tiny example

A dynamic array starts empty, `[]`, with capacity 1 (the exact starting size depends on the implementation). Append three values:

1. Append `10`, giving `[10]`.
2. Append `20`. The array may grow to capacity 2, giving `[10,20]`.
3. Append `30`. The array grows to capacity 4, copies the old values, then writes, giving `[10,20,30,_]`.

Because the capacity doubles, **n appends cost amortized O(1)** each.

## How

1. If the size equals the capacity, allocate a buffer about twice as large and copy the values over.
2. Write at index `size`, then increase the size by one.
3. Inserting in the middle still shifts elements, which costs more than appending.

## Trap

Confusing the amortized O(1) cost of appending with the cost of inserting in the middle.

**Fix:** Growth helps appends. Inserting at index `k` still shifts everything after it.

**Time (n appends):** O(n) total · **Time (insert in the middle):** O(n) · **Space:** O(capacity)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
