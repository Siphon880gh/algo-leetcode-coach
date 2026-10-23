## Tiny example

Sorted `a = [1, 3, 5, 7]`. Insert `4` while keeping sorted order.

Lower_bound = first index with `a[i] >= 4` → index `2` (before `5`).

After insert conceptually: `[1, 3, 4, 5, 7]`.


## How

1. Binary search for the first index `i` where `a[i] >= x` (or `> x` for upper_bound)
2. That index is the insertion point (may be `n` if all elements are smaller)
3. Shift / splice there if you actually mutate an array


## Trap

Returning any index where `a[i] == x` when duplicates exist and you needed the lower edge.

**Fix:** Use the first-True boundary template on `a[i] >= x`.

**Time:** O(log n) search (+ O(n) if shifting an array) · **Space:** O(1) for the search

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
