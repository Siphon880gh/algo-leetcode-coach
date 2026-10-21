## Halve until one is left

1. While `n > 1`: `new[i] = min(a[2i], a[2i + 1])` for even `i`, `max(…)` for odd `i`; `a = new`.
2. Return `a[0]`.

Examples → 1, 3.

The parity is of the new index `i`, not of `2i`, which is always even. n ≤ 1024, and the lengths add to under 2n, so simulation is linear.

Time: O(n)  
Space: O(n), or O(1) writing in place

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
