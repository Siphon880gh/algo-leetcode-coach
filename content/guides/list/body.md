## Tiny example

Dynamic array starts `[]` capacity 1 (implementation-defined). Append sequence:

1. Append `10` → `[10]` 
2. Append `20` → may grow to capacity 2 → `[10,20]`
3. Append `30` → grow to 4, copy, write → `[10,20,30,_]`

Doubling makes **n appends amortized O(1)** each.


## How

1. If size == capacity, allocate ~2× buffer and copy
2. Write at `size`, then size++
3. Mid-insert still shifts — different cost from append


## Trap

Confusing amortized append O(1) with mid-insert O(1).

**Fix:** Growth helps appends. Inserting at index `k` still shifts the tail.

**Time (n appends):** O(n) total · **Time (mid-insert):** O(n) · **Space:** O(capacity)

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
