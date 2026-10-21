## Push collisions down

1. Count letters; sort counts descending.
2. For each `f`: while `f > 0` and `f` is in `used`, `f −= 1`, `deletions += 1`.
3. Add `f` to `used` (0 may repeat freely).

`"aab"` → 0. `"aaabbbcc"` → 2 (3, 3, 2 → 3, 2, 1). `"ceabaacb"` → 2.

At most 26 letters, so the inner loop is short in practice. Do not delete whole letters by default; lowering by one is often enough.

Time: O(n + 26²)  
Space: O(26)

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
