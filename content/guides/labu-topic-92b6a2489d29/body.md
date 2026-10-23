## Tiny example

Binary heap as priority queue.

Array `[9,5,6,2,3]` max-heap. Ops:

1. `peek` → 9
2. `push(10)` → sift up
3. `pop` → replace root with last, sift down

Priority queue ADT = these ops; binary heap is the common layout.


## How

1. Map ADT ops to sift up/down
2. Remember build-heap O(n)
3. For arbitrary delete, keep handles


## Trap

Expecting decrease-key to be O(log n) without an index map.

**Fix:** Store handle→index if you need change-key.

**Time:** peek O(1); push/pop O(log n)

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
