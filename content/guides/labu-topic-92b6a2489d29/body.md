## Tiny example

A binary heap used as a priority queue.

The array `[9, 5, 6, 2, 3]` is a max-heap. Its operations:

1. `peek` returns 9.
2. `push(10)` appends 10 and sifts it up.
3. `pop` moves the last element to the root and sifts it down.

A priority queue is defined by these operations. A binary heap is the usual way to implement it.

## How

1. Map each operation to sifting up or sifting down.
2. Remember that building a heap takes O(n).
3. To delete an arbitrary element, keep handles to elements.

## Trap

Expecting decrease-key to run in O(log n) without a map from elements to their positions.

**Fix:** Store a map from each handle to its index if you need to change keys.

**Time:** `peek` is O(1); `push` and `pop` are O(log n)

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
