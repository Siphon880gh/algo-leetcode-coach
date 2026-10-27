## Levels above the minimum

1. Sort ascending; `level = 0`, `ops = 0`.
2. For `i ≥ 1`: if `a[i] ≠ a[i − 1]`, `level += 1`; `ops += level`.

`[5,1,3]` → 3. `[1,1,1]` → 0. `[1,1,2,2,3]` → 4.

An element with `L` distinct smaller values needs exactly `L` operations, one per step down. Simulating the operations is far too slow for 5 · 10^4 elements.

Time: O(n log n)  
Space: O(1) besides sorting

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
