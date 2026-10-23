## Tiny example

Array: `[5, 1, 9, 3, 7, 8]`, need top `k=3` largest → `{9, 8, 7}`.

Keep a **min-heap of size k**.

1. Push until size k
2. For each new `x`, if `x` > heap top, pop and push `x`
3. Heap holds the k largest; top is the **smallest among them**


## How

1. Choose size-k heap, full sort, or quickselect
2. For heap: maintain size k with the opposite order of what you want
3. Emit heap contents at the end


## Trap

Using a max-heap of size n and popping k times without thinking — fine for small n, but the size-k min-heap uses less memory and O(n log k).

**Fix:** Prefer size-k heap when k ≪ n; quickselect when you only need the k-th threshold.

**Time (size-k heap):** O(n log k) · **Space:** O(k)

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
